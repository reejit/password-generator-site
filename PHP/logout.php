<?php
  session_start();

  // PHP code for logging out
  unset($_SESSION['valid']); // Unsets the $_SESSION['valid'] variable (logs user out)

  header("Location: ..\index.php"); // Redirects to the login page
?>
