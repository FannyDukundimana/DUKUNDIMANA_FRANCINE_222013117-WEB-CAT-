<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our users</title>
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
<body bgcolor="blue">
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
  <h1><u>Users Form</u></h1>
  <form method="post">

    <label for="user_id">User_ID:</label>
    <input type="number" id="user_id" name="user_id" required><br>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="password">Password:</label>
    <input type="text" id="password" name="password" required><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required><br>

    <label for="full_name">Full_Name:</label>
    <input type="text" id="full_name" name="full_name" required><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br>

    <label for="phone_number">Phone_Number:</label>
    <input type="number" id="phone_number" name="phone_number" required><br>

    <label for="registration_date">Registration_Date:</label>
    <input type="date" id="registration_date" name="registration_date" required><br>

    <input type="submit" name="add" value="Insert">
    </form>
  <?php
include('database_connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $stmt = $connection->prepare("INSERT INTO users (user_id, username, password, email, full_name, address, phone_number, registration_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssd", $user_id, $username, $password, $email, $full_name, $address, $phone_number, $registration_date);

    // Set parameters from POST data
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $registration_date = $_POST['registration_date'];

    if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>
                 <a href='users.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    } 
    ?>
    <center><h2>Table of Users</h2>
  <table>
    <tr>
      <th>User_ID</th>
      <th>Username</th>
      <th>Password</th>
      <th>Email</th>
      <th>Full_Name</th>
      <th>Address</th>
      <th>Phone_Number</th>
      <th>Registration_Date</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
$sql = "SELECT * FROM users";
$result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row["user_id"];
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['phone_number']}</td>
                    <td>{$row['registration_date']}</td>
                    <td><a href='delete_users.php?user_id={$row['user_id']}'>Delete</a></td>
                    <td><a href='update_users.php?user_id={$row['user_id']}'>Update</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No data found</td></tr>";
    }
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <h2>UR CBE BIT &copy;, 2024 &reg;</h2>
</footer>

</body>
</html>
