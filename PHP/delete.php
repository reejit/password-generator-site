<?php
  // SQL to delte password from database
  
  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

  require "connect_db.php"; // Connects to the database

  // Get password to delete
  $delete_id = $_GET["delete-id"];

  // Execute SQL
  $sql = "DELETE FROM passwords WHERE id=$delete_id";
  $result = $mysqli->query($sql) or die(mysqli_error($mysqli));

  // Redirect back to the saved passwords page
  header("Location: ../saved_passwords.php")

?>
