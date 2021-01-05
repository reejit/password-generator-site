<link rel="stylesheet" type="text/css" href="CSS/styles.css">
<script src="js/script.js" type="text/javascript"></script>

<?php
  // PHP for displaying the saved passwords

  require "PHP/header.php"; // Get header.php content
  require "PHP/connect_db.php"; // Connects to database

  // If there's a response from SQL statement
  if ($result->num_rows > 0) {

      // output data of each row
      $counter = 1; // Initialise $counter
      while($row = $result->fetch_assoc()) {
        // Decrypt the password first
        $temp_pass = $row["password"];
        $decrypted_pass = include "decrypt.php";

        // When the display is the search results, add 1000 on to the counter to make the ids unique
        if ($display_search == true) {
          $counter = $counter + 1000;
        }
        ?>

        <div class="rounded">

          <!-- Name -->
          <p class='display_pw'><?php echo $row["name"] ?></p><br>

          <?php

          // Checks if there is a username to display
          if ($row["username"]) {

          ?>

            <!-- Username -->
            <label class="display">Username:</label>
            <input id='<?php echo 'username' . $counter ?>' class='display_pw' type='text' value='<?php echo $row["username"] ?>' readonly>

            <!-- Copy username -->
            <input type='button' name='copy' value='Copy' onclick='copy(<?php echo 'username' . $counter ?>)'><br>

          <?php

          } else {
            echo "<p>No username set</p>";
          }

          ?>

          <?php

          // Checks if there is a URL to display
          if ($row["url"]) {

          ?>

            <!-- URL -->
            <label class="display">URL:</label>
            <input id='<?php echo 'url' . $counter ?>' class='display_pw' type='text' value='<?php echo $row["url"] ?>' readonly>

            <!-- Copy URL -->
            <input type='button' name='copy' value='Copy' onclick='copy(<?php echo 'url' . $counter ?>)'>

            <!-- Open URL -->
            <input type='button' name='open' value='Open' onclick='open_url(<?php echo 'url' . $counter ?>)'><br>

          <?php

          } else {
            echo "<p>No URL set</p>";
          }

          ?>

          <!-- Password -->
          <label class="display">Password:</label>
          <input id='<?php echo 'pass' . $counter ?>' class='display_pw' type='password' value='<?php echo $decrypted_pass ?>' readonly>

          <!-- Password copy -->
          <input type='button' name='copy' value='Copy' onclick='copy(<?php echo 'pass' . $counter ?>)'>

          <!-- Show/hide -->
          <label class='container' style='display:inline-block;margin-left:5px;font-size:18px;'>Show/hide
          <input type='checkbox' name='showhide' onclick='show_hide(<?php echo 'pass' . $counter ?>)' style='display: inline;'><span class='checkmark'></span></label><br>

          <!-- Delete -->
          <input type='button' name='delete' value='Delete' onclick='delete_pass(<?php echo $row["passID"] ?>)'>

          <!-- Edit button -->

            <!-- Trigger/Open The Edit UI -->
            <input type="button" value="Edit" onclick="edit(<?php echo 'edit_popup_div' . $counter ?>)">

            <!-- The Edit UI -->
            <div id="<?php echo 'edit_popup_div' . $counter ?>" class="edit">

              <!-- Edit UI content -->
              <div class="edit-content">
                <span id="<?php echo 'span' . $counter ?>" class="close" onclick="edit_hide(<?php echo 'edit_popup_div' . $counter ?>)">&times;</span>
                <!-- Form to edit saved password -->
                <form action="" method="post">

                  <p class="required">* Required fields</p><br><br>

                  <!-- Name -->
                  <label class="add">Name: <p class="required">*</p></label>
                  <input type="text" name="changed_name" autocomplete="save-password-name" value="<?php echo $row["name"] ?>" autofocus required><br>

                  <!-- Username -->
                  <label class="add">Username/email:</label>
                  <input type="text" name="changed_username" value="<?php echo $row["username"] ?>" autocomplete="save-password-username"><br>

                  <!-- URL -->
                  <label class="add">URL:</label>
                  <input type="url" name="changed_url" value="<?php echo $row["url"] ?>" pattern="https?://.+" autocomplete="save-password-url" oninvalid="this.setCustomValidity('Please enter a valid URL (must start with https://)')"><br>

                  <!-- Password -->
                  <label class="add">Password: <p class="required">*</p></label>
                  <input type="password" name="changed_password" autocomplete="off" value="<?php echo $decrypted_pass ?>" required><br>

                  <input style="display:none;" type="text" name="id" autocomplete="off" value="<?php echo $row["passID"] ?>" required><br>

                  <!-- Submit button -->
                  <input type="submit" name="save" value="Save">
                </form>
              </div>

            </div>

        </div><br>

        <?php
            $counter = $counter + 1; // Iterate counter
          }
        }

        ?>

        <!-- Popup message div -->
        <div id='popup'></div>

        <script>

          // Copy function
          function copy(elementID) {
            if (elementID.type == 'password') {
              elementID.type='text';
              elementID.select(); document.execCommand('copy');
              elementID.type='password';
            } else {
              elementID.select(); document.execCommand('copy');
            }

            popup_message("Copied to clipboard!"); // Popup message

          }

          // Show/hide function
          function show_hide(elementID) {
            if (elementID.type =='password') {
              elementID.type = 'text';
            } else {
              elementID.type = 'password';
            }
          }

          // Open URL
          function open_url(elementID) {
            // Gets the URL
            var url = elementID.value;

            // Checks if it is a valid URL (using Regex)
            var valid = url.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);

            // If it is valid, open it in a new window
            if (valid !== null) {
              window.open(url)
            }

            // If it's not valid then Google it
            else {
              window.open('http://google.com/search?q=' + url);
            }
          }

          // Delete
          function delete_pass(delete_id) {
            if (confirm("Are you sure you want to delete this password?")) {
              window.location.href="PHP/delete.php?delete-id=" + delete_id;
            }
          }

          // Edit button popup window

          // When the user clicks the button, open the edit UI
          function edit(elementID) {
            elementID.style.display = "block";
          }

          // When the user clicks the button, open the edit UI
          function edit_hide(elementID) {
            elementID.style.display = "none";
          }

          // Popup message function
          function popup_message(message) {
            // Get the snackbar DIV
            var x = document.getElementById('popup');
            x.innerHTML=message

            // Add the 'show' class to DIV
            x.className = 'show';

            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);
          }

        </script>

        <?php

        // If the form is submitted, save the password
        if(isset($_POST["save"])){

          $new_url = $_POST["changed_url"];

          if (filter_var($new_url, FILTER_VALIDATE_URL) && $new_url) {
            // Not a valid URL message
            $message = "Not a valid URL!";
            include "PHP/popup_message.php";;

          } else {

            // SQL to UPDATE into database
            $sql = $mysqli->prepare("UPDATE passwords SET name = ?, username = ?, url = ?, password = ? WHERE passID = ?");
            $sql->bind_param("ssssi", $new_name, $new_username, $new_url, $encrypted_pass, $passID);

            // Get changed name and password from form
            $new_name = $_POST["changed_name"];
            $new_username = $_POST["changed_username"];
            $new_password = $_POST["changed_password"];
            $new_url = $_POST["changed_url"];
            $passID = $_POST["id"];

            // Encrypt the password before saving to database
            $encrypted_pass = include "PHP/encrypt.php";

            $sql->execute();

            // Refresh the page
            echo "<script type='text/javascript'>window.top.location='saved_passwords.php';</script>";
          }
        }

        ?>
