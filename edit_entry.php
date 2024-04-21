<?php
// Include database connection
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = "password123.."; // Change this to your database password
$dbname = "register"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the ID parameter is set
if(isset($_GET["id"])) {
    $id = $_GET["id"];

    // Retrieve the record from the database based on the ID
    $sql = "SELECT * FROM tableregis WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the record exists
    if($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Display the form with existing record values
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #1877f2;
    }

    form {
        margin-top: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    input[type="text"],
    input[type="tel"],
    textarea,
    input[type="datetime-local"] {
        width: calc(100% - 12px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    textarea {
        resize: vertical;
    }

    input[type="submit"] {
        background-color: #1877f2;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #0e59a0;
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Record</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $row['fullname']; ?>" required><br><br>
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required><?php echo $row['address']; ?></textarea><br><br>
            <label for="datetime">Date and Time:</label>
            <input type="datetime-local" id="datetime" name="datetime"
                value="<?php echo date('Y-m-d\TH:i', strtotime($row['datetime'])); ?>" required><br><br>
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" minlength="11" maxlength="11" value="<?php echo $row['phone']; ?>"
                required><br><br>
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4"><?php echo $row['message']; ?></textarea><br><br>
            <input type="submit" name="submit" value="Update">
        </form>
    </div>
</body>

</html>
<?php
    } else {
        echo "Record not found.";
    }
} else {
    echo "ID parameter is missing.";
}
?>