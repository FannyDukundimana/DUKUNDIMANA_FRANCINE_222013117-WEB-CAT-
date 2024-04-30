<?php
include('database_connection.php');

// Handle POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $fname = $lname = $username = $gender = $email = $telephone = $password = $activation_code = "";

    if (isset($_POST['fname'])) {
        $fname = $connection->real_escape_string($_POST['fname']);
    }
    if (isset($_POST['lname'])) {
        $lname = $connection->real_escape_string($_POST['lname']);
    }
     if (isset($_POST['email'])) {
        $email = $connection->real_escape_string($_POST['email']);
    }
    if (isset($_POST['username'])) {
        $username = $connection->real_escape_string($_POST['username']);
    }
    if (isset($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    if (isset($_POST['telephone'])) {
        $telephone = $connection->real_escape_string($_POST['telephone']);
    }
    if (isset($_POST['activation_code'])) {
        $activation_code = $connection->real_escape_string($_POST['activation_code']);
    }

    // Prepare and execute SQL query
    $sql = "INSERT INTO user (Firstname, Lastname, email, username, password, Telephone, Activation_code) 
            VALUES ('$fname', '$lname', '$email', '$username', '$password', '$telephone', '$activation_code')";

    if ($connection->query($sql) === TRUE) {
        // Redirect to login page on successful registration
        header("Location: login.html");
        exit();
    } else {
        // Display error message if query execution fails
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Close database connection
$connection->close();
?>
