<?php
include('database_connection.php');

if(isset($_REQUEST['review_id'])) {
    $review_id = $_REQUEST['review_id'];
    
    $stmt = $connection->prepare("SELECT * FROM reviews WHERE review_id=?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['review_id'];
        $y = $row['user_id'];
        $z = $row['book_id'];
        $w = $row['rating'];
        $s = $row['review_text'];
        $k = $row['review_date'];
        
    } else {
        echo "reviews not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update reviews</title>
</head>
<body>
    <body bgcolor="pink">
    <form method="POST">
        <label for="user_id">user_id:</label>
        <input type="number" name="user_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="book_id">book_id:</label>
        <input type="number" name="book_id" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="rating">rating:</label>
        <input type="number" name="rating" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="review_text">review_text:</label>
        <input type="text" name="review_text" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="review_date">review_date:</label>
        <input type="date" name="review_date" value="<?php echo isset($w) ? $w : ''; ?>">
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
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];
    $review_date = $_POST['review_date'];
    
    $stmt = $connection->prepare("UPDATE reviews SET user_id=?, book_id=?, rating=?, review_text=?, review_date=? WHERE review_id=?");
    $stmt->bind_param("ssssdi", $user_id, $book_id, $rating, $review_text, $review_date, $review_id);
    $stmt->execute();
    
    header('Location: reviews.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>