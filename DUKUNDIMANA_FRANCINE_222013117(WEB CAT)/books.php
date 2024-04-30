<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our books</title>
  <style>
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }

    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Form styling */
    form {
      margin-top: 20px;
      text-align: center;
      margin: 5px;
      padding: 8px;
    }

    /* Table styling */
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Footer styling */
    footer {
      background-color: darkgray;
      padding: 15px;
      text-align: center;
    }
  </style>
</head>

<body bgcolor="orange">
  <header>
    <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <ul style="list-style-type: none; padding: 0;">
      <li style="display: inline; margin-right: 10px;">
        <img src="./Images/books.jpg" width="90" height="60" alt="Logo">
      </li>
      <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./users.php">USERS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./transactions.php">TRANSACTIONS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./reviews.php">REVIEWS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./books.php">BOOKS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./authors.php">AUTHORS</a></li>
      <li class="dropdown" style="display: inline; margin-right: 10px;">
        <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">SETTINGS</a>
        <div class="dropdown-contents">
          <!-- Links inside the dropdown menu -->
          <a href="login.html">Login</a>
          <a href="register.html">Register</a>
          <a href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
  </header>

  <section>
    <h1><u>Books Form</u></h1>
    <form method="post">
      <label for="bookid">book_id:</label>
      <input type="number" id="bookid" name="bookid" required><br><br>

      <label for="title">title:</label>
      <input type="text" id="title" name="title" required><br><br>

      <label for="author">author:</label>
      <input type="text" id="author" name="author" required><br><br>

      <label for="genre">genre:</label>
      <input type="text" id="genre" name="genre" required><br><br>

      <label for="pubdate">publication_date:</label>
      <input type="date" id="pubdate" name="pubdate" required><br><br>

      <label for="isbn">isbn:</label>
      <input type="text" id="isbn" name="isbn" required><br><br>

      <label for="quantity">quantity_available:</label>
      <input type="number" id="quantity" name="quantity" required><br><br>

      <input type="submit" name="insert" value="Insert">
    </form>

    <?php
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Prepare the statement
        $stmt = $connection->prepare("INSERT INTO books (book_id, title, author, genre, publication_date, isbn, quantity_available) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssi", $book_id, $title, $author, $genre, $pubdate, $isbn, $quantity);

        // Set parameters from POST and execute
        $book_id = $_POST['bookid'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $pubdate = $_POST['pubdate'];
        $isbn = $_POST['isbn'];
        $quantity = $_POST['quantity'];

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>
                 <a href='books.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    } 
    ?>

    <center><h2>Table of Books</h2>
    <table>
      <tr>
        <th>book_id</th>
        <th>title</th>
        <th>author</th>
        <th>genre</th>
        <th>publication_date</th>
        <th>isbn</th>
        <th>quantity_available</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
  
      $sql = "SELECT * FROM books";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $book_id = $row["book_id"]; // Fetch book_id for delete and update links
              echo "<tr>
                  <td>" . $row["book_id"] . "</td>
                  <td>" . $row["title"] . "</td>
                  <td>" . $row["author"] . "</td>
                  <td>" . $row["genre"] . "</td>
                  <td>" . $row["publication_date"] . "</td>
                  <td>" . $row["isbn"] . "</td>
                  <td>" . $row["quantity_available"] . "</td>
                  <td><a href='delete_books.php?book_id=$book_id'>Delete</a></td>
                  <td><a href='update_books.php?book_id=$book_id'>Update</a></td> 
                </tr>";
          }
      } else {
          echo "<tr><td colspan='9'>No data found</td></tr>";
      }
      $connection->close();
      ?>
    </table>
  </section>
  <footer>
    <center><b><h2>UR CBE BIT &copy; 2024 &reg;</h2></b></center>
  </footer>
</body>
</html>
