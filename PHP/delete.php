<?php
  // SQL to delte password from database

  require "header.php"; // Get header.php content
  require "connect_db.php"; // Connects to the database

  // Execute SQL
  $sql = $mysqli->prepare("DELETE FROM passwords WHERE passID=?");
  $sql->bind_param("i", $delete_id);

  // Get password to delete
  $delete_id = $_GET["delete-id"];

  $sql->execute();

  // Redirect back to the saved passwords page
  header("Location: ../saved_passwords.php")
?>
