<?php
include('database_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email=?"; 
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) { // Changed 'Password' to 'password'
            session_start(); // Starting the session
            $_SESSION['user_id'] = $row['id'];
            header("Location: home.html");
            exit();
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "User not found";
    }
    $stmt->close(); // Closing the prepared statement
}
$connection->close();
?>
