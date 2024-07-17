<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set in the $_POST array
    if(isset($_POST['email']) && isset($_POST['password'])) {
        // Establish connection to MySQL database
        $conn = mysqli_connect("localhost", "root", "", "workeazy");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Escape user inputs for security
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Fetch user details from the database based on the provided email
        $query = "SELECT * FROM account WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // User found, verify password
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password,  $row['password'])) { // Plain-text comparison
                // Password matches, login successful
                session_start();
                $_SESSION['email'] = $email; // Store user's email in session
                header("Location: dashboard.php"); // Redirect to user's account page
                exit();
            } else {
                // Password incorrect
                echo "Incorrect password.";
            }
        } else {
            // User not found
            echo "User not found.";
        }

        // Close MySQL connection
        mysqli_close($conn);
    } else {
        echo "Email and password are required.";
    }
} else {
    echo "Invalid request method.";
}
?>
