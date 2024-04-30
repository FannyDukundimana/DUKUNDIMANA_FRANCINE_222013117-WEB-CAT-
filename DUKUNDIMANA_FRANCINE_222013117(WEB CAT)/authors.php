<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our authors</title>
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
<body bgcolor="indigo">
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
    <h1><u>Authors Form</u></h1>
    <form method="post">
      <label for="author_id">Author ID:</label>
      <input type="number" id="author_id" name="author_id" required><br><br>

      <label for="author_name">Author Name:</label>
      <input type="text" id="author_name" name="author_name" required><br><br>

      <label for="date_of_birth">Date of Birth:</label>
      <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

      <label for="place_of_birth">Place of Birth:</label>
      <input type="text" id="Place of Birth" name="Place of Birth" required><br><br>

      <label for="nationality">Nationality:</label>
      <input type="text" id="nationality" name="nationality" required><br><br>

      <label for="biography">Biography:</label>
      <input type="text" id="biography" name="biography" required><br><br>

      <input type="submit" name="insert" value="Insert">
    </form>
    <?php
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        $stmt = $connection->prepare("INSERT INTO authors (author_id, author_name, date_of_birth, place_of_birth, nationality, biography) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $author_id, $author_name, $date_of_birth, $place_of_birth, $nationality, $biography);

        $author_id = $_POST['author_id'];
        $author_name = $_POST['author_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $place_of_birth = $_POST['place_of_birth'];
        $nationality = $_POST['nationality'];
        $biography = $_POST['biography'];

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>
                 <a href='authors.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    } 
    ?>

    <center><h2>Table of Authors</h2>
    <table>
      <tr>
        <th>Author ID</th>
        <th>Author Name</th>
        <th>Date of Birth</th>
        <th>Place of Birth</th>
        <th>Nationality</th>
        <th>Biography</th>
        <th>Delete</th>
        <th>Update</th>
      </tr>
      <?php
      $sql = "SELECT * FROM authors";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $author_id = $row["author_id"];
              echo "<tr>
                  <td>" . $row["author_id"] . "</td>
                  <td>" . $row["author_name"] . "</td>
                  <td>" . $row["date_of_birth"] . "</td>
                  <td>" . $row["place_of_birth"] . "</td>
                  <td>" . $row["nationality"] . "</td>
                  <td>" . $row["biography"] . "</td>
                  <td><a style='padding:4px' href='delete_authors.php?author_id=$author_id'>Delete</a></td>
                  <td><a style='padding:4px' href='update_authors.php?author_id=$author_id'>Update</a></td> 
                </tr>";
          }
      } else {
          echo "<tr><td colspan='8'>No data found</td></tr>";
      }
      $connection->close();
      ?>
    </table>
  </section>
  <footer>
    <center><b><h2>UR CBE BIT &copy; 2024 &reg; DUKUNDIMANA Francine</h2></b></center>
  </footer>
</body>
</html>
