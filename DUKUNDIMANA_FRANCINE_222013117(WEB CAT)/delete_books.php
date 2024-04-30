<?php
include('database_connection.php');
// Function to show delete confirmation
function showDeleteConfirmation($book_id) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($book_id)">Confirm</button>
            <button onclick="returnTobooks()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(book_id) {
        window.location.href = '?book_id=' + book_id + '&confirm=yes';
    }
    function returnTobooks() {
        window.location.href = 'books.php';
    }
    </script>
HTML;
}
if(isset($_REQUEST['book_id'])) {
    $bookid = $_REQUEST['book_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM books WHERE book_id=?");
    $stmt->bind_param("i", $book_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "book_id is not set.";
}

$connection->close();
?>
