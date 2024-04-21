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
$name = $_POST['name'];
$description = $_POST['description'];
$price = isset($_POST['price']) ? $_POST['price'] : null; // Check if price is set
$photo_url = $_POST['photo_url']; // Fix the typo here

// Check if price is empty or null
if ($price === '' || $price === null) {
    echo "Error: Price cannot be empty";
    exit;
}

// Insert new item into the database
$sql = "INSERT INTO itm (name, description, price, photo_url) VALUES ('$name', '$description', $price, '$photo_url')";

// After successful item addition
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    // Redirect to admin dashboard
    header("Location: admin_dashboard.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>