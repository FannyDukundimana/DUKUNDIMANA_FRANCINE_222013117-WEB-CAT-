<?php
include('database_connection.php');
// Function to show delete confirmation
function showDeleteConfirmation($review_id) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($review_id)">Confirm</button>
            <button onclick="returnToreviews()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(review_id) {
        window.location.href = '?review_id=' + review_id + '&confirm=yes';
    }
    function returnToreviews() {
        window.location.href = 'reviews.php';
    }
    </script>
HTML;
}
if(isset($_REQUEST['review_id'])) {
    $review_id = $_REQUEST['review_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM reviews WHERE review_id=?");
    $stmt->bind_param("i", $review_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "review_id is not set.";
}

$connection->close();
?>
