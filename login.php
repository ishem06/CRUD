<?php
// Start session
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "password123..";
$dbname = "register";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch admin user
    $sql = "SELECT * FROM admino WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If a row is found
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check username and password (replace with your authentication logic)
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify password
            if ($password === 'password123..') { // Check against the plain password
                // Set session variables and redirect to admin dashboard
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['username'] = 'admin'; // Set the username to 'admin'
                header("Location: admin_dashboard.php"); // Redirect to admin dashboard page
                exit();
            } else {
                $_SESSION['error_message'] = "Invalid password";
            }
        } else {
            $_SESSION['error_message'] = "Admin user not found";
        }
    }
    
    // Check if there's an error message in the session
    if (isset($_SESSION['error_message'])) {
        $error_message = $_SESSION['error_message'];
        unset($_SESSION['error_message']); // Clear the error message from the session
    }
    
    // Embed JavaScript to hide the error message after 3 seconds
    if (isset($error_message)) {
        echo "<script>
                // Hide the error message after 3 seconds
                setTimeout(function() {
                    var errorMessage = document.getElementById('error-message');
                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }
                }, 3000);
              </script>";
    }

}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<style>
body {
    font-family: 'Arial', sans-serif;
    background-color: #1877f2;
    /* Facebook background color */
    margin: 0;
    padding: 0;
}

.container {
    background-color: #f5f5f5;
    /* Light gray background */
    max-width: 400px;
    margin: 160px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #1877f2;
    /* Facebook Blue */
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    /* Dark gray */
    font-weight: bold;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    /* Light gray border */
    border-radius: 4px;
    box-sizing: border-box;

}

input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #1877f2;
    /* Facebook Blue */
    color: #fff;
    /* White text */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
}

input[type="submit"]:hover {
    background-color: #0e59a0;
    /* Darker shade of Facebook Blue */
}

.error-message {
    color: #f00;
    /* Red */
    margin-top: 10px;
    text-align: center;
}
</style>

<body>
    <div class="container">
        <h2>Admin Login</h2>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>
            <?php if (isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
            <?php } ?>

            <input type="submit" value="Login">
        </form>
    </div>

    </form>
    </div>
    <script>
    // Hide the error message after 3 seconds if it exists
    window.onload = function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 3000); // Adjust the delay (3000 milliseconds) as needed
        }
    };
    </script>

</body>
</body>

</html>