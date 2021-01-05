<!DOCTYPE html>
<?php require "PHP\header.php" ?>
<html>

  <head>
    <title>Account Details</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/theme.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <div class="content-wrap">

      <!-- Logout button -->
      <input type="button" value="Log out" id="logout_button">
      <h1>Account Details</h1>

      <!-- Navigation bar -->
      <div class="nav" id="navbar">
        <a href="saved_passwords.php">Saved passwords</a>
        <a href="generator.php">Password Generator</a>
        <a href="add_password.php">Add Password</a>
        <a class="active" href="account_details.php">Account Details</a>
        <a href="javascript:void(0);" class="icon" onclick="nav()">
          <i class="fa fa-bars"></i>
        </a>
      </div><br>

      <!-- Welcomes the user -->
      <?php echo "<p>Hello, " . $_SESSION['username'] . "</p>"; ?>

      <h2>Change password</h2>

      <!-- Form change master password -->
      <form action="" method="post">
        <!-- Old master password -->
        <label class="details">Old master password:</label>
        <input type="password" name="old_pass" autofocus required><br>

        <!-- New master password -->
        <label class="details">New master password:</label>
        <input type="password" name="new_pass" required><br>

        <!-- Save button -->
        <input type="submit" name="save" value="Save">
      </form>

      <!-- Delete account button -->
      <input type='button' name='delete' value='Delete account' onclick='delete_account()'>

      <script>
        // Delete account
        function delete_account () {
          if (confirm("Are you sure you want to delete your account?")) {
            window.location.href="PHP/delete_account.php";
          }
        }
      </script>

      <br><h2>Theme</h2>

      <!-- Theme switch -->
      <label class="spaced">Light</label>
      <label class="switch">
        <input type="checkbox" id="theme" onclick="theme_toggle()">
        <span class="toggle"></span>
      </label>
      <label class="spaced">Dark</label>

      <script>
      // JavaScript for toggling the theme using the switch
      function theme_toggle() {

        // Get checkbox
        var check = document.getElementById("theme");

        // If checked, set theme to dark (save to local storage)
        if (check.checked == true){
          localStorage.setItem("dark",1)
          document.documentElement.classList.add("dark-mode");
        } else {
          // Else set to light
          localStorage.setItem("dark",0)
          document.documentElement.classList.remove("dark-mode");
        }

      }
      </script>

      <?php
        // PHP code to change the master password
        require "PHP/connect_db.php"; // Connects to database

        if (isset($_POST["save"])) {

          // Lookup username in database
          $sql = $mysqli->prepare("SELECT masterPass FROM users WHERE username = ?");
          $sql->bind_param("s", $username);

          $username = $_SESSION['username'];

          // Execute
          $sql->execute();
          $result = $sql->get_result();
          $row = $result->fetch_assoc();

          // Get old and new master passwords from form and hash them
          $old_pass_hash = hash("sha256",$_POST['old_pass']);
          $new_pass_hash = hash("sha256",$_POST['new_pass']);

          // Get actual password hash
          $password_hash = $row["masterPass"];

          // Compare the hashes to see if the password is correct
          if ($old_pass_hash == $password_hash) {

            // SQL statement for updating password
            $sql = $mysqli->prepare("UPDATE users SET masterPass = ? WHERE username = ?");
            $sql->bind_param("ss", $new_pass_hash, $username);

            // Get parameters
            $new_pass_hash = hash("sha256",$_POST['new_pass']);
            $username = $_SESSION['username'];

            // Execute
            $sql->execute();

            // Password changed message
            $message = "Password changed!";
            include "PHP/popup_message.php";

          } else {
            // Incorrect master password message
            $message = "Incorrect master password!";
            include "PHP/popup_message.php";
          }

        }

      ?>
    </div>

    <!-- External JavaScript -->
    <script src="js/script.js" type="text/javascript"></script>

    <!-- Checks if dark theme is enabled and toggles the switch accordingly -->
    <script>
      if (localStorage.getItem("dark") == 1) {
        document.getElementById("theme").checked = true;
      } else {
        document.getElementById("theme").checked = false;
      }
    </script>

  </body>
</html>
