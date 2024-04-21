<?php
// Include database connection and start session
session_start();
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

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Retrieve data from the database
$sql = "SELECT * FROM tableregis";
$result = $conn->query($sql);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f2f5;
    color: #333;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1877f2;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th,
td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tr {
    border-bottom: 1px solid #ccc;
}

tr:last-child {
    border-bottom: none;
}


.logout {
    text-align: center;
    margin-top: 20px;
}

.logout a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #1877f2;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.logout a:hover {
    background-color: #0e59a0;
}
</style>

<body>
    <div class="container">
        <h2>Admin Dashboard</h2>

        <!-- Display existing data -->
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 1px solid #ccc;">
                    <th style="padding: 10px; border: 1px solid #ccc; background-color: #f2f2f2; font-weight: bold;">
                        Full Name</th>
                    <th style="padding: 10px; border: 1px solid #ccc; background-color: #f2f2f2; font-weight: bold;">
                        Address</th>
                    <th style="padding: 10px; border: 1px solid #ccc; background-color: #f2f2f2; font-weight: bold;">
                        Date and Time</th>
                    <th style="padding: 10px; border: 1px solid #ccc; background-color: #f2f2f2; font-weight: bold;">
                        Phone Number</th>
                    <th style="padding: 10px; border: 1px solid #ccc; background-color: #f2f2f2; font-weight: bold;">
                        Message</th>
                    <th style="padding: 10px; border: 1px solid #ccc; background-color: #f2f2f2; font-weight: bold;">
                        Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr style='border-bottom: 1px solid #ccc;'>";
                echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . $row['fullname'] . "</td>";
                echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . $row['address'] . "</td>";
                echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . $row['datetime'] . "</td>";
                echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . $row['phone'] . "</td>";
                echo "<td style='padding: 10px; border: 1px solid #ccc;'>" . $row['message'] . "</td>";
                echo "<td style='padding: 10px; border: 1px solid #ccc;'>";
                echo "<a href='edit_entry.php?id=" . $row['id'] . "' style='margin-right: 5px; padding: 6px 12px; background-color: #1877f2; color: #fff; text-decoration: none; border-radius: 4px;'>Edit</a>";
                echo "<a href='delete_entry.php?id=" . $row['id'] . "' style='padding: 6px 12px; background-color: #1877f2; color: #fff; text-decoration: none; border-radius: 4px;'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='padding: 10px; border: 1px solid #ccc;'>No data available</td></tr>";
        }
        ?>
            </tbody>
        </table>


        <!-- Logout link -->
        <div class="logout">
            <a href="admin_logout.php">Logout</a>
        </div>
    </div>






</body>

</html>