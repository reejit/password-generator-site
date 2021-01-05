<!DOCTYPE html>
<?php
  session_start(); // Start PHP session

  // Redirects the user if they are already logged in
  if (isset($_SESSION['valid'])) {
    header("Location: saved_passwords.php");
  }
?>
<html>

  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/theme.js" type="text/javascript"></script>
  </head>

  <body>
    <div class="content-wrap">

      <h1>Log in</h1>

      <!-- Master password form -->
      <form style="clear: both;" action = "" method="post" id="master_login">
        <!-- Username -->
        <input id="username" type="text" name="username" placeholder="Enter username" autofocus>

        <!-- Master password -->
        <input id="password" type="password" name="master_password" placeholder="Enter master password" autofocus>

        <!-- Submit button -->
        <input type="submit" name="login" value="Log in">
      </form>

      <!-- Link to register -->
      <br><label>Not got an account?</label><br><br><a href="register.php"><input type="button" name="register" id="register_button" value="Register"></a>

      <?php

      // PHP code for checking the master password (logging in)

      require "PHP/connect_db.php";

      error_reporting(0); // Turns off error reporting

      // If the login button is pressed and the password field isn't empty, verify password
      if (isset($_POST['login']) && !empty($_POST['master_password'])) {

        // Lookup username in database
        $sql = $mysqli->prepare("SELECT masterPass,userID,username FROM Users WHERE username = ?");
        $sql->bind_param("s", $username);

        // Get username and password from form
        $username = $_POST["username"];

        // Execute
        $sql->execute();

        $result = $sql->get_result();
        $row = $result->fetch_assoc();

        // Check if that username is in the database
        if ($row) {

          // Get password attempt
          $password = $_POST["master_password"];

          // Hash password from username
          $attempt_hash = hash("sha256",$password);

          // Get password hash from database
          $password_hash = $row["masterPass"];

          // Compare hashes
          if ($attempt_hash == $password_hash) {

            // The hashes match, so the password is correct
            $_SESSION['valid'] = true; // Sets the $_SESSION['valid'] variable (logs user in)
            $_SESSION['timeout'] = time();
            $_SESSION['userID'] = $row["userID"];
            $_SESSION['username'] = $row["username"];

            header('Refresh: 0;'); // Refreshes the page

          } else {
            // Password is incorrect
            // Display password incorrect message

            $message = "Password incorrect!";
            include "PHP/popup_message.php";

          }

        } else {
          // Username is not found
          // Display username not found message

          $message = "Username not found!";
          include "PHP/popup_message.php";

        }

      }

      ?>
    </div>
  </body>
</html>
