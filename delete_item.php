<?php
// Connect to the database
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = "password123.."; // Change this to your database password
$dbname = "register"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect item ID from the request
$id = $_POST['id']; // Assuming you're passing the item ID through a form or URL parameter

// Delete the item from the database
$sql = "DELETE FROM items WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// Close the database connection
$conn->close();
?>