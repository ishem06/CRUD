
<?php
// Include the connection file
include 'connect.php';

// SQL query
$sql = "SELECT * FROM your_table_name"; // Change this to your table name

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
