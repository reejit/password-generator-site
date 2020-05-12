<link rel="stylesheet" type="text/css" href="CSS/styles.css">

<?php
  // PHP for displaying the saved passwords

  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

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
            <input id='<?php echo 'username' . $counter ?>' class='display_pw' type='text' value='<?php echo $row["username"] ?>' readonly>

            <!-- Copy username -->
            <input type='button' name='copy' value='Copy' onclick='<?php echo 'copy_username' . $counter ?>()'><br>

          <?php

          } else {
            echo "<br>No username set<br>";
          }

          ?>

          <!-- Password -->
          <input id='<?php echo 'pass' . $counter ?>' class='display_pw' type='password' value='<?php echo $decrypted_pass ?>' readonly>

          <!-- Password copy -->
          <input type='button' name='copy' value='Copy' onclick='<?php echo 'copy_temp' . $counter ?>()'>

          <!-- Show/hide -->
          <label class='container' style='display:inline-block;margin-left:5px;font-size:18px;'>Show/hide
          <input type='checkbox' name='showhide' onclick='<?php echo 'showhide' . $counter ?>()' style='display: inline;'><span class='checkmark'></span></label><br>

          <!-- Delete -->
          <input type='button' name='delete' value='Delete' onclick='<?php echo 'delete' . $counter ?>()'>

        </div><br>

        <script>

          function <?php echo 'copy_temp' . $counter ?> () {
            if (document.getElementById('<?php echo 'pass' . $counter ?>').type == 'password') {
              document.getElementById('<?php echo 'pass' . $counter ?>').type='text';
              var copyText=document.getElementById('<?php echo 'pass' . $counter ?>');
              copyText.select(); document.execCommand('copy');
              document.getElementById('<?php echo 'pass' . $counter ?>').type='password';
            } else {
              var copyText=document.getElementById('<?php echo 'pass' . $counter ?>');
              copyText.select(); document.execCommand('copy');
            }

            popup_message("Copied to clipboard!") // Popup message

          }

          function <?php echo 'showhide' .$counter ?> () {
            var x = document.getElementById('<?php echo 'pass' . $counter ?>');
            if (x.type =='password') {
              x.type = 'text';
            } else {
              x.type = 'password';
            }
          }

          function <?php echo 'copy_username' . $counter ?> () {
            var copyTextNew=document.getElementById('<?php echo 'username' . $counter ?>');
            copyTextNew.select(); document.execCommand('copy');

            popup_message("Copied to clipboard!") // Popup message
          }

          function <?php echo 'delete' . $counter ?> () {
            if (confirm("Are you sure you want to delete this password?")) {
              console.log("Deleted");
              window.location.href="PHP/delete.php?delete-id=<?php echo $row["id"] ?>";
            }
          }

        </script>

        <div id='snackbar'></div>
        <script src="js/script.js" type="text/javascript"></script>

        <?php

        $counter = $counter + 1; // Iterate counter
      }
  }
?>
