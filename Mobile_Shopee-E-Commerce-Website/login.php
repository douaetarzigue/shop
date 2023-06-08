<?php
// Include the database configuration
require('database/DBController.php');

// Create a database connection
$db = new DBController();

// Initialize variables
$username = $password = '';
$error = '';

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the input values (you can add more validation if needed)
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        // Perform the login check against the 'user' table
        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $db->con->query($query);

        if ($result->num_rows > 0) {
            // Login successful
            
            header('Location: index.php');
            exit();
        } else {
            // Login failed
            $error = 'Invalid username or password';
        }
    }
}
include ('header.php');
// Display the login form
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .login-form {
            width: 50%;
            height: 50%;
            margin-left: 300px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-form"> <!-- Add a class for styling -->
            <form method="POST" action="login.php">
                <!-- Your login form code here -->

                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input type="text" name="username" id="username" class="form-control" />
                    <label class="form-label" for="username">Username</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name="password" id="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rememberMe" name="rememberMe" checked />
                            <label class="form-check-label" for="rememberMe"> Remember me </label>
                        </div>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" name="loginBtn" class="btn btn-primary btn-block mb-4">Sign in</button>

                <!-- Register button -->
                <div class="text-center">
                    <p>Not a member? <a href="./signin.php">Register</a></p>
                </div>
            </form>
        </div> <!-- End of login-form div -->

        <!-- Include Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
