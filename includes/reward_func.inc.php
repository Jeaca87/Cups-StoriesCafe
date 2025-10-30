<?php
require_once __DIR__ . '/dbconnect.php'; // ✅ safer absolute path

/**
 * Fetch all rewards (with optional pagination)
 */
function getAllRewards(PDO $pdo, ?int $limit = null, int $offset = 0): array
{
    try {
        $sql = "SELECT * FROM rewards ORDER BY r_start_date DESC";

        if ($limit !== null) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $pdo->prepare($sql);

        if ($limit !== null) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error in getAllRewards: " . $e->getMessage());
        return [];
    }
}

/**
 * Fetch one reward (for edit or view)
 */
function getRewardById(PDO $pdo, int $id): ?array
{
    try {
        $stmt = $pdo->prepare("SELECT * FROM rewards WHERE r_id = :id");
        $stmt->execute([':id' => $id]);
        $reward = $stmt->fetch(PDO::FETCH_ASSOC);
        return $reward ?: null;
    } catch (PDOException $e) {
        error_log("Database error in getRewardById: " . $e->getMessage());
        return null;
    }
}

/**
 * Add a new reward
 */
function addReward(PDO $pdo, array $data): bool
{
    if (!isset($data['name'], $data['category'], $data['start_date'], $data['expired_date'], $data['point'])) {
        return false;
    }

    $point = filter_var($data['point'], FILTER_VALIDATE_INT);
    if ($point === false || $point < 0) {
        return false;
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO rewards (r_name, r_category, r_start_date, r_expired_date, r_point)
            VALUES (:name, :category, :start_date, :expired_date, :point)
        ");
        $stmt->execute([
            ':name' => trim($data['name']),
            ':category' => trim($data['category']),
            ':start_date' => $data['start_date'],
            ':expired_date' => $data['expired_date'],
            ':point' => $point
        ]);
        return true;
    } catch (PDOException $e) {
        error_log("Database error in addReward: " . $e->getMessage());
        return false;
    }
}

/**
 * Update existing reward
 */
function updateReward(PDO $pdo, int $id, array $data): bool
{
    if (!isset($data['name'], $data['category'], $data['start_date'], $data['expired_date'], $data['point'])) {
        return false;
    }

    $point = filter_var($data['point'], FILTER_VALIDATE_INT);
    if ($point === false || $point < 0) {
        return false;
    }

    try {
        $stmt = $pdo->prepare("
            UPDATE rewards
            SET r_name = :name,
                r_category = :category,
                r_start_date = :start_date,
                r_expired_date = :expired_date,
                r_point = :point
            WHERE r_id = :id
        ");
        $stmt->execute([
            ':name' => trim($data['name']),
            ':category' => trim($data['category']),
            ':start_date' => $data['start_date'],
            ':expired_date' => $data['expired_date'],
            ':point' => $point,
            ':id' => $id
        ]);
        return true;
    } catch (PDOException $e) {
        error_log("Database error in updateReward: " . $e->getMessage());
        return false;
    }
}
