<?php
  // PHP for deleting an account

  require "connect_db.php"; // Connects to database
  require "header.php"; // Get header.php content

  // Delete all passwords from that user
  $sql = $mysqli->prepare("DELETE FROM passwords WHERE userID = ?");
  $sql->bind_param("i", $userID)

  // Get parameters
  $userID = $_SESSION["userID"]; // Get userID from session cookie

  // Execute
  $sql->execute();

  // Delete the user from the databse
  $sql = $mysqli->prepare("DELETE FROM users WHERE userID = ?");
  $sql->bind_param("i", $userID)

  // Get parameter
  $userID = $_SESSION["userID"]; // Get userID from session cookie

  // Execute
  $sql->execute();

  // Redirect to the logout page
  header("Location: logout.php");
?>
