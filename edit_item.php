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

// Collect form data
$id = $_POST['id']; // Assuming you have an input field for the item ID in your form
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

// Update the item in the database
$sql = "UPDATE items SET name='$name', description='$description', price=$price WHERE id=$id";

// After successful item update
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    // Redirect to admin dashboard
    header("Location: admin_dashboard.php");
    exit;
} else {
    echo "Error updating record: " . $conn->error;
}


// Close the database connection
$conn->close();
?>