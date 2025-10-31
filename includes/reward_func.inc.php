<?php
require_once __DIR__ . '/dbconnect.php';

/**
 * Get all rewards
 */
function getAllRewards(PDO $pdo): array
{
    try {
        $stmt = $pdo->query("SELECT * FROM rewards ORDER BY r_start_date DESC");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("getAllRewards error: " . $e->getMessage());
        return [];
    }
}

/**
 * Get a single reward
 */
function getRewardById(PDO $pdo, int $id): ?array
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM rewards WHERE r_id = :id");
        $stmt->execute([':id' => $id]);
        $reward = $stmt->fetch();
        return $reward ?: null;
    } catch (PDOException $e) {
        error_log("getRewardById error: " . $e->getMessage());
        return null;
    }
}

/**
 * Add a new reward
 */
function addReward($pdo, $data)
{
    try {
        $sql = "INSERT INTO rewards 
                (r_name, r_category, r_percent, r_start_date, r_expired_date, r_point, r_description)
                VALUES 
                (:r_name, :r_category, :r_percent, :r_start_date, :r_expired_date, :r_point, :r_description)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':r_name'         => $data['name'] ?? '',
            ':r_category'     => $data['category'] ?? '',
            ':r_percent'      => $data['percent'] ?? 0,
            ':r_start_date'   => $data['start_date'] ?? '',
            ':r_expired_date' => $data['expired_date'] ?? '',
            ':r_point'        => $data['point'] ?? 0,
            ':r_description'  => $data['description'] ?? ''
        ]);

        return true;
    } catch (PDOException $e) {
        error_log("Error adding reward: " . $e->getMessage());
        return false;
    }
}

/**
 * Update reward
 */
function updateReward(PDO $pdo, int $id, array $data): bool
{
    $point = filter_var($data['point'], FILTER_VALIDATE_INT);
    $percent = isset($data['percent']) ? (float) $data['percent'] : 0;
    $description = $data['description'] ?? '';

    try {
        $stmt = $pdo->prepare("
            UPDATE rewards
            SET r_name = :name,
                r_category = :category,
                r_percent = :percent,
                r_start_date = :start_date,
                r_expired_date = :expired_date,
                r_point = :point,
                r_description = :description
            WHERE r_id = :id
        ");
        return $stmt->execute([
            ':name' => trim($data['name']),
            ':category' => trim($data['category']),
            ':percent' => $percent,
            ':start_date' => $data['start_date'],
            ':expired_date' => $data['expired_date'],
            ':point' => $point,
            ':description' => trim($description),
            ':id' => $id
        ]);
    } catch (PDOException $e) {
        error_log("updateReward error: " . $e->getMessage());
        return false;
    }
}

/**
 * Delete reward
 */
function deleteReward(PDO $pdo, int $id): bool
{
    try {
        $stmt = $pdo->prepare("DELETE FROM rewards WHERE r_id = :id");
        return $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        error_log("deleteReward error: " . $e->getMessage());
        return false;
    }
}
