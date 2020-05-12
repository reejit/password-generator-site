<?php
  // PHP code for logging out
  
  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

  session_start(); // Starts PHP session

  unset($_SESSION['valid']); // Unsets the $_SESSION['valid'] variable (logs user out)

  header('Refresh: 0; URL = ../index.php'); // Redirects to the login page
?>
