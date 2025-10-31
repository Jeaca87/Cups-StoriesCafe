<?php
require_once __DIR__ . '/dbconnect.php';

/**
 * Get active rewards (between r_start_date and r_expired_date)
 */
function getActiveRewards(PDO $pdo): array
{
    $today = date('Y-m-d');
    $sql = "SELECT r_id, r_name, r_category, r_description, r_percent, r_point, r_start_date, r_expired_date
            FROM rewards
            WHERE (r_start_date IS NULL OR r_start_date <= :today)
              AND (r_expired_date IS NULL OR r_expired_date >= :today)
            ORDER BY r_id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['today' => $today]);
    return $stmt->fetchAll();
}

/**
 * Get reward by ID
 */
function getRewardById(PDO $pdo, int $id)
{
    $stmt = $pdo->prepare("SELECT * FROM rewards WHERE r_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

/**
 * Get customer reward account (points, tier level)
 */
function getCustomerRewards(PDO $pdo, int $c_id)
{
    $stmt = $pdo->prepare("SELECT * FROM customer_rewards WHERE c_id = ?");
    $stmt->execute([$c_id]);
    return $stmt->fetch() ?: null;
}

/**
 * Get reward history by customer reward ID
 */
function getRewardHistory(PDO $pdo, int $cusr_id): array
{
    $sql = "SELECT h.rh_id, h.dated_redeemed, h.points_used, h.redeemed,
                   r.r_name, r.r_description
            FROM rewards_history h
            LEFT JOIN rewards r ON h.r_id = r.r_id
            WHERE h.cusr_id = ?
            ORDER BY h.dated_redeemed DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cusr_id]);
    return $stmt->fetchAll();
}

/**
 * Redeem reward (deduct points, insert history)
 */
function redeemReward(PDO $pdo, int $c_id, int $reward_id): array
{
    $pdo->beginTransaction();
    try {
        // Get customer_reward row (for points)
        $custStmt = $pdo->prepare("SELECT cusr_id, points FROM customer_rewards WHERE c_id = ? FOR UPDATE");
        $custStmt->execute([$c_id]);
        $cust = $custStmt->fetch();

        if (!$cust) {
            $pdo->rollBack();
            return ['success' => false, 'message' => 'Customer not found in customer_rewards.'];
        }

        $cusr_id = (int)$cust['cusr_id'];
        $points = (int)$cust['points'];

        // Get reward details
        $reward = getRewardById($pdo, $reward_id);
        if (!$reward) {
            $pdo->rollBack();
            return ['success' => false, 'message' => 'Reward not found.'];
        }

        $today = date('Y-m-d');
        if (!empty($reward['r_start_date']) && $reward['r_start_date'] > $today) {
            $pdo->rollBack();
            return ['success' => false, 'message' => 'Reward not yet active.'];
        }
        if (!empty($reward['r_expired_date']) && $reward['r_expired_date'] < $today) {
            $pdo->rollBack();
            return ['success' => false, 'message' => 'Reward has expired.'];
        }

        $requiredPoints = (int)$reward['r_point'];
        if ($points < $requiredPoints) {
            $pdo->rollBack();
            return ['success' => false, 'message' => 'Not enough points.'];
        }

        // Deduct points
        $newPoints = $points - $requiredPoints;
        $update = $pdo->prepare("UPDATE customer_rewards SET points = ? WHERE cusr_id = ?");
        $update->execute([$newPoints, $cusr_id]);

        // Insert history
        $insert = $pdo->prepare("INSERT INTO rewards_history (cusr_id, r_id, dated_redeemed, points_used, redeemed)
                                 VALUES (?, ?, NOW(), ?, 'yes')");
        $insert->execute([$cusr_id, $reward_id, $requiredPoints]);

        $pdo->commit();
        return [
            'success' => true,
            'message' => 'Reward redeemed successfully.',
            'remaining_points' => $newPoints
        ];
    } catch (Exception $e) {
        $pdo->rollBack();
        return ['success' => false, 'message' => 'Server error: ' . $e->getMessage()];
    }
}
