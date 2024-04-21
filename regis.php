<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
    <title>Form Submit to Send Email</title>
    <link rel="stylesheet" type="text/css" href="regist.css">
</head>
<style>
body {
    font-family: 'Times New Roman', Times, serif;
    background-color: #f0e6d2;
    /* Faded yellowish paper */
    margin: 0;
    padding: 0;
}

.form-container {
    background-color: #f5f5f5;
    /* Light gray background */
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-container h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
    font-size: 28px;
}

.form-group {
    margin-bottom: 20px;
}

.message-box {

    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #f0f0f0;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}


/* Style success message */
.success-message {
    color: green;
}

/* Style error message */
.error-message {
    color: red;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #333;
    /* Dark gray text */
    font-size: 18px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

.form-group textarea {
    resize: vertical;
}

.form-group input[type="submit"] {
    background-color: #333;
    /* Dark gray button */
    color: white;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 18px;
}

.form-group input[type="submit"]:hover {
    background-color: #555;
    /* Dark gray hover */
}

.form-group::after {
    content: '';
    display: block;
    border-bottom: 2px solid #333;
    /* Dark gray divider */
    margin-top: 20px;
}
</style>

<body>

    <?php
    // Database connection parameters
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
    ?>

    <div class="message-box">
        <?php
    // If the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters
        $stmt = $conn->prepare("INSERT INTO tableregis (fullname, address, datetime, phone, message) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("sssss", $fullname, $address, $datetime, $phone, $message);

        // Set parameters
        $fullname = $_POST['fullname'];
        $address = $_POST['address'];
        $datetime = date('Y-m-d H:i:s', strtotime($_POST['datetime']));
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            // Display success message
            echo '<div id="success-message" class="success-message">New record created successfully</div>';
            
            // Redirect to the homepage after 3 seconds
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "client.html";
                    }, 3000);
                  </script>';
        } else {
            // Display error message
            echo '<div class="error-message">Error: ' . $stmt->error . '</div>';
        }

        // Close statement  
        $stmt->close();
    }

    // Close connection
    $conn->close();
    ?>
    </div>

    <div class="form-container">
        <h2>ORDERING FORM</h2>
        <form action="#" method="post">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>

            <label for="datetime">Date and Time:</label>
            <input type="datetime-local" id="datetime" name="datetime" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" title="Please enter numbers only" minlength="11" maxlength="11"
                required>


            <label for="message">List of Orders:</label>
            <textarea id="message" name="message" rows="4"></textarea>

            <input type="submit" value="Submit">
        </form>
    </div>

</body>

</html>