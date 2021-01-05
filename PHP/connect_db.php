<?php
  // PHP code for connecting database
  error_reporting(0); // Turn of error repoprting

  // variables to connect
  $host =  "localhost";
  $username = "admin_user";
  $password = "password";
  $database = "passwordmanager";

  // create a database connection instance
  $mysqli = new mysqli($host, $username, $password, $database);

  // Check connection
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }
?>
