<!DOCTYPE html>
<?php require "PHP\header.php" ?>
<html>

  <head>
    <title>Add Password</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/theme.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <div class="content-wrap">

      <!-- Logout button -->
      <input type="button" value="Log out" id="logout_button">
      <h1>Add Password</h1>

      <!-- Navigation bar -->
      <div class="nav" id="navbar">
        <a href="saved_passwords.php">Saved passwords</a>
        <a href="generator.php">Password Generator</a>
        <a class="active" href="add_password.php">Add Password</a>
        <a href="account_details.php">Account Details</a>
        <a href="javascript:void(0);" class="icon" onclick="nav()">
          <i class="fa fa-bars"></i>
        </a>
      </div><br>

      <h2>Enter new password:</h2>
      <p class="required">* Required fields</p>

      <!-- Form to add new password to database -->
      <form action="" method="post">
        <!-- Name -->
        <label class="add">Name: <p class="required">*</p></label>
        <input type="text" name="name" autocomplete="save-password-name" autofocus required><br>

        <!-- Username -->
        <label class="add">Username/email:</label>
        <input type="text" name="username" autocomplete="save-password-username"><br>

        <!-- URL -->
        <label class="add">URL:</label>
        <input type="url" name="url" pattern="https?://.+" autocomplete="save-password-url" oninvalid="this.setCustomValidity('Please enter a valid URL (must start with https://)')"><br>

        <!-- Password -->
        <label class="add">Password: <p class="required">*</p></label>
        <input type="password" name="password" autocomplete="off" required><br>

        <!-- Submit button -->
        <input type="submit" name="submit" value="Add">
      </form>

      <?php include "PHP/add.php"; // Adds the password ?>

    </div>

    <!-- External JavaScript -->
    <script src="js/script.js" type="text/javascript"></script>

  </body>
</html>
