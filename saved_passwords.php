<!DOCTYPE html>
<?php
  session_start(); // Start PHP session

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
  }
?>
<html>

  <head>
    <title>Saved Passwords</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <div class="page-container">
      <div class="content-wrap">

        <h1>Saved passwords</h1>
        <input type="button" value="Log out" id="logout_button">

        <!-- Navigation bar -->
        <ul>
          <li><a class="active" href="saved_passwords.php">Saved passwords</a></li>
          <li><a href="generator.php">Password Generator</a></li>
          <li><a href="add_password.php">Add Password</a></li>
        </ul><br>

        <form action="" method="post" id="search_form">
          <input type="text" name="keyword" id="search" placeholder="Search passwords">
          <input type="submit" name="submit_search" value="Search">
        </form>

        <?php

          // If the submit button is pressed and the search box isn't empty, search for keyword
          if(isset($_POST['submit_search']) && !empty($_POST['keyword'])){

            require "PHP/connect_db.php"; // Connects to database

            // Gets keyword from form
            $form_search = $_POST["keyword"];
            $form_search = filter_var($form_search, FILTER_SANITIZE_STRING);

            // Search database
            $sql = "SELECT id, name, username, password FROM passwords WHERE name LIKE '%" . $form_search . "%'";
            $result = $mysqli->query($sql);

            // Displays title with the current search
            echo '<h2>Search results for "' . $form_search . '"</h2>'; // Creates title

            // Displays the number of results found
            if ($result->num_rows == 1) {
              echo '<p>1 result found</p><br><br>';
            } else {
              echo '<p>' . $result->num_rows . ' results found</p><br><br>';
            }

            $display_search = true;
            include "PHP/display.php"; // Display result of SQL query

          }

          require "PHP/connect_db.php"; // Connects to database

          // Display passwords
          $sql = "SELECT id, name, username, password FROM passwords";
          $result = $mysqli->query($sql);

          echo "<h2>All passwords</h2>"; // Creates title

          // Displays the number of saved passwords
          if ($result->num_rows == 1) {
            echo '<p>You have 1 saved password</p><br><br>';
          } else {
            echo '<p>You have ' . $result->num_rows . ' saved passwords</p><br><br>';
          }

          $display_search = false;
          include "PHP/display.php"; // Display passwords

          $mysqli->close(); // Close connection to database

        ?>

      </div>
    </div>

    <!-- External JavasScript -->
    <script src="js/script.js" type="text/javascript"></script>

  </body>
</html>
