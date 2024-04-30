<?php
include('database_connection.php');
// Function to show delete confirmation
function showDeleteConfirmation($transaction_id) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($manufacturer_id)">Confirm</button>
            <button onclick="returnTotransactions()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(transaction_id) {
        window.location.href = '?transaction_id=' + transaction_id + '&confirm=yes';
    }
    function returnTotransaction() {
        window.location.href = 'transactions.php';
    }
    </script>
HTML;
}
if(isset($_REQUEST['transaction_id'])) {
    $transid = $_REQUEST['transaction_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM transactions WHERE transaction_id=?");
    $stmt->bind_param("i", $book_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "transaction_id is not set.";
}

$connection->close();
?>
