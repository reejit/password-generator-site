<?php
  // PHP code for connecting database

  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

  // variables to connect
  $host =  "localhost";
  $username = "admin_user";
  $password = "password";
  $database = "passwordmanager";

  // create a database connection instance
  $mysqli = new mysqli($host, $username, $password, $database);
?>
