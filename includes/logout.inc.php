<?php
// logout.php
session_start();

require_once 'csrf_token.inc.php';

// Validate CSRF token for logout
if (!isset($_GET['token']) || !validateCsrfToken($_GET['token'])) {
    $_SESSION['error'] = "Invalid logout request";
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

// Clear all session data
$_SESSION = array();

// Delete session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Destroy session
session_destroy();

// Start new session for message
session_start();
$_SESSION['success'] = "You have been logged out successfully";

// Redirect to login page
header("Location: ../index.php");
exit();
