<!DOCTYPE html>
<html>

  <head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/theme.js" type="text/javascript"></script>
  </head>

  <body>
  <div class="page-container">
    <div class="content-wrap">

      <h1 class="login">Register</h1>

      <!-- Master password form -->
      <form style="clear: both;" action = "" method="post" id="master_login">
        <!-- Username -->
        <input id="username" type="text" name="username" placeholder="Enter a username" autofocus required>

        <!-- Master password -->
        <input id="password" type="password" name="master_password" placeholder="Enter a master password" required>

        <!-- Confirm master password -->
        <input id="password" type="password" name="confirm_master_password" placeholder="Confirm master password" required>

        <!-- Submit button -->
        <input type="submit" name="register" value="Register">
      </form>

      <!-- Link to login -->
      <br><label>Already got an account?</label><br><br><a href="index.php"><input type="button" name="login" id="login_button" value="Log in"></a>

      <?php

      // PHP code for checking the master password (logging in)

      require "PHP/connect_db.php";
      error_reporting(0); // Turns off error reporting

      // If the login button is pressed and the password field isn't empty, verify password
      if (isset($_POST['register'])) {

        // Lookup username in database to check for duplicates
        $sql = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
        $sql->bind_param("s", $new_username);

        // Get username from form
        $new_username = $_POST["username"];

        // Execute
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {

          $new_password = $_POST["master_password"];
          $confirm_new_password = $_POST["confirm_master_password"];

          if ($new_password == $confirm_new_password) {

            // SQL to insert into database
            $sql = $mysqli->prepare("INSERT INTO Users (username,masterPass) VALUES(?, ?)");
            $sql->bind_param("ss", $new_username, $hashed_pass);

            // Get parameters
            $new_username = $_POST["username"];
            $hashed_pass = hash("sha256",$new_password);

            // Execute
            $sql->execute();

            // Create popup message: "Password added!"
            $message = "Account created!";
            include "PHP/popup_message.php";

            header("Location: index.php");

          } else {

            // Create popup message: "Password do not match!"
            $message = "Passwords do not match!";
            include "PHP/popup_message.php";

          }

        } else {

          // Create popup message: "That username already exists!"
          $message = "That username already exists!";
          include "PHP/popup_message.php";

        }

      }

      ?>

      </div>
    </div>
  </body>
</html>
