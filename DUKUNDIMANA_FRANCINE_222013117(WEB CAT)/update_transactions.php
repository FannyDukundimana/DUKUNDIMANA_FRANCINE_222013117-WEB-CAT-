<?php
include('database_connection.php');

// Initialize variables
$user_id = $book_id = $loan_date = $return_date = '';

// Check if transaction_id is set in the request
if(isset($_REQUEST['transaction_id'])) {
    $transaction_id = $_REQUEST['transaction_id'];
    
    // Prepare and execute the SELECT query to fetch transaction details
    $stmt = $connection->prepare("SELECT * FROM transactions WHERE transaction_id=?");
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if transaction exists
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign fetched values to variables
        $user_id = $row['user_id'];
        $book_id = $row['book_id'];
        $loan_date = $row['loan_date'];
        $return_date = $row['return_date'];
    } else {
        echo "Transaction not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update transactions</title>
</head>
<body bgcolor="pink">
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?= $user_id ?>">
        <br><br>

        <label for="book_id">Book ID:</label>
        <input type="number" name="book_id" value="<?= $book_id ?>">
        <br><br>

        <label for="loan_date">Loan Date:</label>
        <input type="date" name="loan_date" value="<?= $loan_date ?>">
        <br><br>

        <label for="return_date">Return Date:</label>
        <input type="date" name="return_date" value="<?= $return_date ?>">
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
    $loan_date = $_POST['loan_date'];
    $return_date = $_POST['return_date'];
    
    // Prepare and execute the UPDATE query
    $stmt = $connection->prepare("UPDATE transactions SET user_id=?, book_id=?, loan_date=?, return_date=? WHERE transaction_id=?");
    $stmt->bind_param("iissi", $user_id, $book_id, $loan_date, $return_date, $transaction_id);
    $stmt->execute();
    
    // Redirect to transactions.php after updating
    header('Location: transactions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
