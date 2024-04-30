<?php
include('database_connection.php');
// Function to show delete confirmation
function showDeleteConfirmation($author_id) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($author_id)">Confirm</button>
            <button onclick="returnToauthors()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(author_id) {
        window.location.href = '?author_id=' + author_id + '&confirm=yes';
    }
    function returnToauthors() {
        window.location.href = 'authors.php';
    }
    </script>
HTML;
}
if(isset($_REQUEST['author_id'])) {
    $aid = $_REQUEST['author_id'];
    
    $stmt = $connection->prepare("DELETE FROM authors WHERE author_id=?");
    $stmt->bind_param("i", $author_id);
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "author_id is not set.";
}

$connection->close();
?>
