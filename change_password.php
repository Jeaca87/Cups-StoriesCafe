<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</head>

<body>
    <h2>Change Password</h2>

    <form action="../../../includes/update_password.inc.php" method="post">
        <label>Current Password</label><br>
        <input type="password" id="current" name="current_password" required>
        <button type="button" onclick="togglePassword('current')">Show</button><br><br>

        <label>New Password</label><br>
        <input type="password" id="new" name="new_password" required>
        <button type="button" onclick="togglePassword('new')">Show</button><br><br>

        <label>Confirm Password</label><br>
        <input type="password" id="confirm" name="confirm_password" required>
        <button type="button" onclick="togglePassword('confirm')">Show</button><br><br>

        <button type="submit" name="submit">Save</button>
    </form>

    <br>
    <button onclick="window.location.href='account.php'">Back to Account</button>
</body>

</html>