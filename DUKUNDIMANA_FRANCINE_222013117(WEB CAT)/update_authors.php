<?php
include('database_connection.php');

if(isset($_REQUEST['author_id'])) {
    $aid = $_REQUEST['author_id'];
    
    $stmt = $connection->prepare("SELECT * FROM authors WHERE author_id=?");
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['author_id'];
        $y = $row['author_name'];
        $z = $row['date_of_birth'];
        $w = $row['place_of_birth'];
        $n = $row['nationality'];
        $b = $row['biography'];
    } else {
        echo "Author not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update authors</title>
</head>
<body bgcolor="pink">
    <form method="POST">
        <label for="aname">Author Name:</label>
        <input type="text" name="author_name" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="dobirth">Date of Birth:</label>
        <input type="date" name="date_of_birth" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="pobirth">Place of Birth:</label>
        <input type="text" name="place_of_birth" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="nationality">Nationality:</label>
        <input type="text" name="nationality" value="<?php echo isset($n) ? $n : ''; ?>">
        <br><br>

        <label for="biography">Biography:</label>
        <input type="text" name="biography" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
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
    $aname = $_POST['author_name'];
    $dobirth = $_POST['date_of_birth'];
    $pobirth = $_POST['place_of_birth'];
    $nationality = $_POST['nationality'];
    $biography = $_POST['biography'];
    
    $stmt = $connection->prepare("UPDATE authors SET author_name=?, date_of_birth=?, place_of_birth=?, nationality=?, biography=? WHERE author_id=?");
    $stmt->bind_param("sssssi", $aname, $dobirth, $pobirth, $nationality, $biography, $aid);
    $stmt->execute();
    
    header('Location: authors.php');
    exit(); // Ensure that no otherer content is sent after the header redirection
}
?>
