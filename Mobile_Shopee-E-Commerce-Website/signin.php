<?php
// Include the database configuration
require('database/DBController.php');

// Create a database connection
$db = new DBController();

// Initialize variables
$username = $password = '';
$error = '';

// Check if the sign-in form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate the input values (you can add more validation if needed)
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {

        // SQL query to insert the user into the "users" table
        $query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";

        // Execute the query
        $result = $db->con->query($query);

        // Check if the query was successful
        if ($result) {
            // Redirect the user to the desired page after successful sign-in
            header('Location: index.php');
            exit();
        } else {
            $error = 'Something went wrong. Please try again later.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <h2>Sign In</h2>
    <?php if (!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Sign In">
    </form>
</body>
</html>
