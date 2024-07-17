<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if first_name is set in the $_POST array
    if(isset($_POST['fname'])) {
        $fname = $_POST['fname'];
    } else {
        $fname = ""; // Set default value if not set
    }

    // Check if last_name is set in the $_POST array
    if(isset($_POST['lname'])) {
        $lname = $_POST['lname'];
    } else {
        $lname = ""; // Set default value if not set
    }

    // Check if email is set in the $_POST array
    if(isset($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $email = ""; // Set default value if not set
    }

    // Check if password is set in the $_POST array
    if(isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $password = ""; // Set default value if not set
    }

    // Establish connection to MySQL database
    $conn = mysqli_connect("localhost", "root", "", "workeazy");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // SQL injection protection
    $first_name = mysqli_real_escape_string($conn, $fname);
    $last_name = mysqli_real_escape_string($conn, $lname);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);


    // Check if the user already exists
    $existing_query = "SELECT * FROM account WHERE email = '$email' OR fname = '$fname'";
    $result = mysqli_query($conn, $existing_query);
    if (mysqli_num_rows($result) > 0) {
        echo "User with the same email or name already exists.";
        exit();
    }


    // Hash the password for security
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $query = "INSERT INTO account (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')";

    if (mysqli_query($conn, $query)) {
        echo "Sign up successful. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Close MySQL connection
    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>
