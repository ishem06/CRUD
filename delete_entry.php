<?php
// Include database connection
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = "password123.."; // Change this to your database password
$dbname = "register"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare and execute SQL statement to delete entry with the specified ID
    $sql = "DELETE FROM tableregis WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        // If deletion is successful, redirect back to admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // If an error occurs, display error message
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // If ID parameter is not set, display error message
    echo "ID parameter is missing.";
}

// Close connection
$conn->close();
?>