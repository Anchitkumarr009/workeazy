<?php
// Start session
session_start();

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to the Dashboard</h2>
    <!-- You can add any content you want to display on the dashboard -->
    <p>Hello, <?php echo $_SESSION['email']; ?>!</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
