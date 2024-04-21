<?php
// Include database connection
session_start();
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = "password123.."; // Change this to your database password
$dbname = "register"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Collect form data
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $datetime = $_POST['datetime'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    
    // Update data in the database
    $sql = "UPDATE tableregis SET fullname='$fullname', address='$address', datetime='$datetime', phone='$phone', message='$message' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Form data not submitted.";
}

// Close database connection
$conn->close();
?>