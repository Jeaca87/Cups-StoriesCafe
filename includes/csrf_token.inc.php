<?php
include __DIR__ . '/dbconnect.php';
// csrf_helper.php - Include this file sa lahat ng pages with forms

/**
 * Generate CSRF token
 */
function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF token
 */
function validateCsrfToken($token)
{
    if (!isset($_SESSION['csrf_token']) || !isset($token)) {
        return false;
    }

    // Use hash_equals to prevent timing attacks
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Generate CSRF token input field
 */
function csrfField()
{
    $token = generateCsrfToken();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

/**
 * Regenerate CSRF token (call after successful login/logout)
 */
function regenerateCsrfToken()
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
