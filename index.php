<?php
session_start();

// Check if the user is an admin
if (isset($_SESSION['admin'])) {
    header('Location: /admin/dashboard.php');
    exit();
}

// Check if the user is a regular user
if (isset($_SESSION['user'])) {
    header('Location: /user/index.php');
    exit();
}

// If no session is set, redirect to user login page
header('Location: /user/login.php');
exit();
?>
