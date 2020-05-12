<?php
  // Displays a logout button if the user is logged in
  
  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

  // Checks if the user is logged in
  if (isset($_SESSION['valid'])) {
    // User is logged in so display the logout button

?>

  <footer>
    <input type="button" value="Log out" id="logout_button">
  </footer>

  <!-- External JavaScript for logout button -->
  <script src="js/script.js" type="text/javascript"></script>

<?php

} // Closes if statement in PHP code

?>
