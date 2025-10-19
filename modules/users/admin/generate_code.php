<?php
session_start();
require_once '../../../includes/dbconnect.php';

// ✅ Require admin session
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    exit('Forbidden: Admin access required.');
}

// ✅ Generate CSRF token kung wala pa
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

try {
    // ✅ Kunin lahat ng codes
    $stmt = $pdo->query("SELECT id, role, assigned_to, used_by, expires_at, used_at, created_at FROM cashier_codes ORDER BY created_at DESC");
    $codes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log('DB error: ' . $e->getMessage());
    $codes = [];
}

// ✅ Success message (galing sa session)
$success = $_SESSION['gen_success'] ?? null;
unset($_SESSION['gen_success']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Cashier Codes</title>

</head>

<body>
    <h1>Cashier Staff Codes</h1>

    <!-- ✅ Generate new code form -->
    <form method="POST" action="../../../includes/generate_code.inc.php">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        <button type="submit">Generate New Cashier Code</button>
    </form>

    <?php if ($success): ?>
        <p class="success">
            ✅ New code generated: <strong><?= htmlspecialchars($success) ?></strong><br>
            <small>Give this code to the cashier for registration.</small>
        </p>
    <?php endif; ?>

    <!-- ✅ Codes list -->
    <?php if (!empty($codes)): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Status</th>
                <th>Assigned To</th>
                <th>Used By</th>
                <th>Expires At</th>
                <th>Created At</th>
            </tr>
            <?php foreach ($codes as $c): ?>
                <?php
                $status = '';
                if (!empty($c['used_at'])) {
                    $status = '<span class="status-used">Used</span>';
                } elseif (!empty($c['expires_at']) && strtotime($c['expires_at']) < time()) {
                    $status = '<span class="status-expired">Expired</span>';
                } else {
                    $status = '<span class="status-unused">Unused</span>';
                }
                ?>
                <tr>
                    <td><?= htmlspecialchars($c['id']) ?></td>
                    <td><?= htmlspecialchars($c['role']) ?></td>
                    <td><?= $status ?></td>
                    <td><?= htmlspecialchars($c['assigned_to'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($c['used_by'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($c['expires_at'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($c['created_at'] ?? '-') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No cashier codes found.</p>
    <?php endif; ?>
</body>

</html>