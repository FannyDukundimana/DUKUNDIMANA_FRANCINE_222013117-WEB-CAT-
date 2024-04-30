<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
</head>
<body style="background-color: orange;"> 
<a href="home.html">&larr; Back to home</a>

<?php
include('database_connection.php');

if(isset($_GET['query'])) {
    $searchTerm = $connection->real_escape_string($_GET['query']);
    $queries = [
        'books' => "SELECT book_id, title, genre  
                    FROM books 
                    WHERE book_id LIKE '%$searchTerm%' 
                    OR title LIKE '%$searchTerm%' 
                    OR genre LIKE '%$searchTerm%'",
        'authors' => "SELECT author_id, author_name 
                      FROM authors
                      WHERE author_id LIKE '%$searchTerm%' 
                      OR author_name LIKE '%$searchTerm%'",
        'transactions' => "SELECT transaction_id, loan_date 
                            FROM transactions
                            WHERE transaction_id LIKE '%$searchTerm%' 
                            OR loan_date LIKE '%$searchTerm%'",
        'reviews' => "SELECT review_id, review_text 
                      FROM reviews
                      WHERE review_id LIKE '%$searchTerm%' 
                      OR review_text LIKE '%$searchTerm%'",
        'users' => "SELECT user_id, username 
                    FROM users 
                    WHERE user_id LIKE '%$searchTerm%' 
                    OR username LIKE '%$searchTerm%'",
    ];

    echo "<h2><u>Search Results:</u></h2>";
    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table: " . ucfirst($table) . "</h3>"; 

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>";
                foreach ($row as $key => $value) {
                    echo "<strong>$key</strong>: $value ";
                }
                echo "</p>";
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
</body>
</html>
