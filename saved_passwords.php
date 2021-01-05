<!DOCTYPE html>
<?php require "PHP/header.php" ?>
<html>

  <head>
    <title>Saved Passwords</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/theme.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <div class="content-wrap">
      <!-- Logout button -->
      <input type="button" value="Log out" id="logout_button">
      <h1>Saved Passwords</h1>

      <!-- Navigation bar -->
      <div class="nav" id="navbar">
        <a class="active" href="saved_passwords.php">Saved passwords</a>
        <a href="generator.php">Password Generator</a>
        <a href="add_password.php">Add Password</a>
        <a href="account_details.php">Account Details</a>
        <a href="javascript:void(0);" class="icon" onclick="nav()">
          <i class="fa fa-bars"></i>
        </a>
      </div><br>

      <!-- Search box -->
      <form action="" method="post" id="search_form">
        <input type="text" name="keyword" id="search" placeholder="Search passwords" required>
        <input type="submit" name="submit_search" value="Search">
      </form>

      <?php
      require "PHP/connect_db.php"; // Connects to database

      // If the submit button is pressed and the search box isn't empty, search for keyword
      if(isset($_POST['submit_search'])) {

        // Search database
        $sql = $mysqli->prepare("SELECT passID, name, username, url, password FROM passwords WHERE name LIKE ? AND userID = ?");
        $sql->bind_param("si", $form_search, $userID);

        // Gets keyword from form and userID
        $form_search = '%' . $_POST["keyword"] . '%';
        $userID = $_SESSION["userID"];

        // Execute
        $sql->execute();
        $result = $sql->get_result();

        // Displays title with the current search
        echo '<h2>Search results for "' . $_POST["keyword"] . '"</h2>'; // Creates title

        // Displays the number of results found
        if ($result->num_rows == 1) {
          echo '<p>1 result found</p><br>';
        } else {
          echo '<p>' . $result->num_rows . ' results found</p><br>';
        }

        $display_search = true;
        include "PHP/display.php"; // Display result of SQL query

      }

      // Display passwords
      $sql = $mysqli->prepare("SELECT passID, name, username, url, password FROM passwords WHERE userID = ?");
      $sql->bind_param("i", $userID);

      // Get parameters
      $userID = $_SESSION["userID"];

      // Execute
      $sql->execute();
      $result = $sql->get_result();

      echo "<h2>All passwords</h2>"; // Creates title

      // Displays the number of saved passwords
      if ($result->num_rows == 1) {
        echo '<p>You have 1 saved password</p><br>';
      } else {
        echo '<p>You have ' . $result->num_rows . ' saved passwords</p><br>';
      }

      $display_search = false;
      include "PHP/display.php"; // Display passwords

      ?>
    </div>

    <!-- External JavasScript -->
    <script src="js/script.js" type="text/javascript"></script>

  </body>
</html>
