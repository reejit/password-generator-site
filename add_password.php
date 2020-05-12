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
    <title>Add Password</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
    <div class="page-container">
      <div class="content-wrap">

        <h1>Add Password</h1>
        <input type="button" value="Log out" id="logout_button">

        <!-- Navigation bar -->
        <ul>
          <li><a href="saved_passwords.php">Saved passwords</a></li>
          <li><a href="generator.php">Password Generator</a></li>
          <li><a class="active" href="add_password.php">Add Password</a></li>
        </ul><br>

        <h2>Enter new password:</h2>

        <!-- Form to add new password to database -->
        <form action="" method="post">
          <!-- Name -->
          <label class="add">Name:</label>
          <input type="text" name="name" autocomplete="save-password-name" autofocus required><br>

          <!-- Username -->
          <label class="add">Username/email:</label>
          <input type="text" name="username" autocomplete="save-password-username"><br>

          <!-- Password -->
          <label class="add">Password:</label>
          <input type="password" name="password" autocomplete="off" required><br>

          <!-- Submit button -->
          <input type="submit" name="submit" value="Add">
        </form>

        <?php
          // PHP code to add the password to the database

          require "PHP/connect_db.php"; // Connects to database
          include "PHP/add.php"; // Adds the password

        ?>

      </div>
    </div>

    <!-- External JavaScript -->
    <script src="js/script.js" type="text/javascript"></script>

  </body>
</html>
