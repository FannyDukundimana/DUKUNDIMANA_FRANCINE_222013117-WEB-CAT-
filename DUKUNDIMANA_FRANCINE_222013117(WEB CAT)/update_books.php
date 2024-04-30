<?php
include('database_connection.php');

if(isset($_REQUEST['book_id'])) {
    $bookid = $_REQUEST['book_id'];
    
    $stmt = $connection->prepare("SELECT * FROM books WHERE book_id=?");
    $stmt->bind_param("i", $bookid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['book_id'];
        $y = $row['title'];
        $z = $row['author'];
        $w = $row['genre'];
        $y = $row['publication_date'];
        $y = $row['isbn'];
        $w = $row['quantity_available'];
    } else {
        echo "books not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update books</title>
</head>

<html>
<body>
    <body bgcolor="pink">
    <form method="POST">
        <label for="title">title:</label>
        <input type="text" name="title" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="author">author:</label>
        <input type="text" name="author" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="genre">genre:</label>
        <input type="text" name="genre" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="publication_date">publication_date:</label>
        <input type="text" name="publication_date" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="isbn">isbn:</label>
        <input type="text" name="isbn" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="quantity_available">quantity_available:</label>
        <input type="number" name="quantity_available" value="<?php echo isset($w) ? $w : ''; ?>">
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
    $title = $_POST['title'];
    $author = $_POST['author'];
    $gender = $_POST['genre'];
    $pubdate= $_POST['publication_date'];
    $isbn = $_POST['isbn'];
    $quantity = $_POST['quantity_available'];
    

    $stmt = $connection->prepare("UPDATE books SET  title=?, author=?, genre=?, publication_date=?, isbn=?, quantity_available=?, WHERE book_id=?");
    $stmt->bind_param("ssssdi", $title, $author, $genre, $pubdate, $isbn, $quantity, $bookid);
    $stmt->execute();
    // Redirect to books.php
    header('Location: books.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>