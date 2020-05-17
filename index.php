<!DOCTYPE html>
<?php
  session_start(); // Start PHP session

  // Redirects the user to the saved passwords page if they are already logged in
  if (isset($_SESSION['valid'])) {
    header("Location: saved_passwords.php");
  }
?>
<html>

  <head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="CSS/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
  <div class="page-container">
    <div class="content-wrap">

      <h1 class="login">Login page</h1>

      <!-- Master password form -->
      <form action = "" method="post" id="master_login">
        <!-- Master password -->
        <input id="password" type="password" name="master_password" placeholder="Enter master password" autofocus>

        <!-- Submit button -->
        <input type="submit" name="login" value="Login">
      </form>

      <input type="button" onclick="(function(){ document.getElementById('change_form').style.display = 'block'; })()" name="change_password" value="Change master password">

      <!-- Change master password form -->
      <br><form action = "" method="post" id="change_form" style="display:none;">
        <!-- Master password -->
        <label class="master">Current master password:</label>
        <input id="password" type="password" name="master_password" autofocus required><br>

        <!-- New password -->
        <label class="master">New password:</label>
        <input id="new_password" type="password" name="new_password" required><br>

        <!-- Confirm new password -->
        <label class="master">Confirm new password:</label>
        <input id="confirm_new_password" type="password" name="confirm_new_password" required><p id="not_matching" style="color:red;"></p><br>

        <!-- Submit button -->
        <input type="submit" name="change_password" value="Change password">
      </form>

      <script>

        document.getElementById('confirm_new_password').addEventListener('keyup', function(event) {
          if (!(document.getElementById('new_password').value === document.getElementById('confirm_new_password').value) ) {
            document.getElementById('not_matching').innerHTML = " Passwords don't match";
          } else {
            document.getElementById('not_matching').innerHTML = "";
          }
        });

      </script>

      <?php

        include "PHP/login.php"; // Login PHP

        if (isset($_POST['change_password'])) {

          // Get variables from form
          $master_password = $_POST["master_password"];
          $new_password = $_POST["new_password"];
          $confirm_new_password = $_POST["confirm_new_password"];

          // Password hash. Password is hashed so that it is not stored in plain text
          $password_hash = rtrim(file_get_contents("password_hash.txt"));

          // Hash password from form
          $attempt_hash = hash("sha256",$master_password);

          // Compare hashes
          if ($attempt_hash == $password_hash) {
            if ($new_password == $confirm_new_password) {
              $new_hashed = hash("sha256",$new_password);
              $file = fopen("password_hash.txt","w");
              fwrite($file, $new_hashed);
              fclose($file);

              include "PHP/update_encryption.php";

            } else {
              // Display passwords don't match message
              $message = "Passwords don't match. Password not changed";
              include "PHP/popup_message.php";
            }

        } else {
          // Display master password incorrect message
          $message = "Master password incorrect! Password not changed";
          include "PHP/popup_message.php";
        }

      }

      ?>

      </div>
    </div>
  </body>
</html>
