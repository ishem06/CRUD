<?php
session_start();

// Check if user is authenticated as admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in as admin
    exit();
}

// Admin page content goes here
echo "Welcome, Admin!";
?>