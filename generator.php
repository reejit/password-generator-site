<!DOCTYPE html>
<?php require "PHP/header.php" ?>
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
      <h1>Password Generator</h1>

      <!-- Navigation bar -->
      <div class="nav" id="navbar">
        <a href="saved_passwords.php">Saved passwords</a>
        <a class="active" href="generator.php">Password Generator</a>
        <a href="add_password.php">Add Password</a>
        <a href="account_details.php">Account Details</a>
        <a href="javascript:void(0);" class="icon" onclick="nav()">
          <i class="fa fa-bars"></i>
        </a>
      </div><br>

      <!-- Length slider -->
      <h2>Select Length:</h2>
      <div class="slidecontainer">
        <input type="range" min="1" max="100" value="8" class="slider" id="length">
        <p>Length: <span id="display"></span></p>
      </div>

      <!-- Javascript for slider -->
      <script>
        var slider = document.getElementById("length");
        var output = document.getElementById("display");
        output.innerHTML = slider.value;

        slider.oninput = function() {
          output.innerHTML = this.value;
        }
      </script>

      <!-- Checkboxes -->

      <h2>Character set:</h2>

      <!-- Upper case -->
      <label class="container">Upper Case <p class="inline">(ABCDFEGHIJKLMNOPQRSTUVWXYZ)</p>
        <input type="checkbox" id="upper" name="upper" value="Upper Case">
        <span class="checkmark"></span>
      </label>

      <!-- Lower case -->
      <label class="container">Lower Case <p class="inline">(abcdefghijklmnopqrstuvwxyz)</p>
        <input type="checkbox" id="lower" name="lower" value="Lower Case" checked>
        <span class="checkmark"></span>
      </label>

      <!-- Numbers -->
      <label class="container">Numbers <p class="inline">(0123456789)</p>
        <input type="checkbox" id="numbers" name="numbers" value="Numbers">
        <span class="checkmark"></span>
      </label>

      <!-- Special characters -->
      <label class="container">Special Characters <p class="inline">(!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~)</p>
        <input type="checkbox" id="special" name="special" value="Special Characters">
        <span class="checkmark"></span>
      </label>

      <!-- Warning (hidden when page is loaded) -->
      <p id="warning" style="display: none;">Please select an option!</p>

      <!-- Command buttons -->
      <input type="button" name="generate" id="generate" value="Generate">
      <input type="button" name="copy" id="copy" value="Copy">
      <input type="button" name="clear" id="clear" value="Clear">

      <!-- Generated password output field -->
      <br><input type="text" value="" id="passwordOutput">

      <!-- Save button -->
      <br><input type="button" name="save" id="save_button" value="Save" style="display:none;">

      <!-- Cancel button -->
      <input type="button" name="cancel" id="cancel_button" value="Cancel" style="display:none;">

      <!-- Save password fields -->
      <form id="save_form" style="display:none;" action="" method="post">

        <br><p class="required">* Required fields</p><br>

        <!-- Name -->
        <label class="add">Name: <p class="required">*</p></label>
        <input type="text" name="name" autocomplete="save-password-name" required autofocus><br>

        <!-- Username -->
        <label class="add">Username/email:</label>
        <input type="text" name="username" autocomplete="save-password-username"><br>

        <!-- URL -->
        <label class="add">URL:</label>
        <input type="url" name="url" pattern="https?://.+" autocomplete="save-password-url" oninvalid="this.setCustomValidity('Please enter a valid URL (must start with https://)')"><br>

        <!-- Password -->
        <label class="add">Password: <p class="required">*</p></label>
        <input id="password_field" type="text" name="password" required><br>

        <!-- Submit -->
        <input type="submit" name="submit" value="Add">
      </form>

      <?php include "PHP/add.php"; // Adds the password ?>

    </div>

    <!-- External JavaScript -->
    <script src="js/generate_script.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>

  </body>
</html>
