<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our transactions</title>
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
<body bgcolor="skyblue">

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
    <li style="display: inline; margin-right: 10px;"><a href="./transactions.php">TRANSACTION</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./reviews.php">REVIEWS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./books.php">BOOKS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./authors.php">AUTHORS</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: red; text-decoration: none; margin-right: 15px;">Settings</a>
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
  <h1><u>Transactions Form</u></h1>
  <form method="post">
    <label for="transaction_id">Transaction_id:</label>
    <input type="number" id="transaction_id" name="transaction_id" required><br><br>

    <label for="user_id">User ID:</label>
    <input type="number" id="user_id" name="user_id" required><br><br>

    <label for="book_id">Book ID:</label>
    <input type="number" id="book_id" name="book_id" required><br><br>

    <label for="loan_date">Loan Date:</label>
    <input type="date" id="loan_date" name="loan_date" required><br><br>

    <label for="return_date">Return Date:</label>
    <input type="date" id="return_date" name="return_date" required><br><br>

    <input type="submit" name="insert" value="Insert"><br><br>
  </form>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
      $stmt = $connection->prepare("INSERT INTO transactions (transaction_id, user_id, book_id, loan_date, return_date) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("iiiss", $transaction_id, $user_id, $book_id, $loan_date, $return_date);

      $transaction_id = $_POST['transaction_id'];
      $user_id = $_POST['user_id'];
      $book_id = $_POST['book_id'];
      $loan_date = $_POST['loan_date'];
      $return_date = $_POST['return_date'];

      if ($stmt->execute()) {
          echo "New record has been added successfully.<br><br>
               <a href='transactions.html'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $stmt->error;
      }

      $stmt->close();
  }

  $connection->close();
  ?>
  
  <center><h2>Table of Transactions</h2>
  <table>
    <tr>
      <th>Transaction ID</th>
      <th>User ID</th>
      <th>Book ID</th>
      <th>Loan Date</th>
      <th>Return Date</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include('database_connection.php');

    $sql = "SELECT * FROM transactions";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $transaction_id = $row["transaction_id"]; 
            echo "<tr>
                <td>" . $row["transaction_id"] . "</td>
                <td>" . $row["user_id"] . "</td>
                <td>" . $row["book_id"] . "</td> 
                <td>" . $row["loan_date"] . "</td>
                <td>" . $row["return_date"] . "</td>
                <td><a style='padding:4px' href='delete_transactions.php?transaction_id=$transaction_id'>Delete</a></td>
                <td><a style='padding:4px' href='update_transactions.php?transaction_id=$transaction_id'>Update</a></td> 
              </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    $connection->close();
    ?>
  </table>
</section>
<footer>
  <center><b><h2>UR CBE BIT &copy, 2024 &reg;</h2></b></center>
</footer>

</body>
</html>
