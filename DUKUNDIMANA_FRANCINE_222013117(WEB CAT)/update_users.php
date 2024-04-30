<?php
include('database_connection.php');

if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    $stmt = $connection->prepare("SELECT * FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $password = $row['password'];
        $email = $row['email'];
        $full_name = $row['full_name'];
        $address = $row['address'];
        $phone_number = $row['phone_number'];
        $registration_date = $row['registration_date'];
    } else {
        echo "User not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update users</title>
</head>
<body bgcolor="pink">
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
        <br><br>

        <label for="password">Password:</label>
        <input type="text" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>

        <label for="full_name">Full_name:</label>
        <input type="text" name="full_name" value="<?php echo isset($full_name) ? $full_name : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
        <br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">
        <br><br>

        <label for="registration_date">Registration Date:</label>
        <input type="date" name="registration_date" value="<?php echo isset($registration_date) ? $registration_date : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate()">
        
    </form>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</body>
</html>
<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $registration_date = $_POST['registration_date'];
    
    // Update the user in the database
    $stmt = $connection->prepare("UPDATE users SET username=?, password=?, email=?, full_name=?, address=?, phone_number=?, registration_date=? WHERE user_id=?");
    $stmt->bind_param("ssssdsdi", $username, $password, $email, $full_name, $address, $phone_number, $registration_date, $user_id);
    $stmt->execute();
    
    // Redirect to users.php
    header('Location: users.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
