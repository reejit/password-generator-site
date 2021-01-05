<?php
  // PHP to add a password to the database

  require "PHP/connect_db.php"; // Connects to database
  require "PHP/header.php"; // Get header.php content

  // If the form is submitted, save the password
  if(isset($_POST["submit"])){

    // SQL to insert into database
    $sql = $mysqli->prepare("INSERT INTO passwords (name,username,url,password,userID) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("ssssi", $new_name, $new_username, $new_url, $encrypted_pass, $userID);

    // Get parameters

    // Get name and password from form
    $new_name = $_POST["name"];
    $new_username = $_POST["username"];
    $new_url = $_POST["url"];
    $new_password = $_POST["password"];
    $userID = $_SESSION["userID"];

    // Encrypt the password before saving to database
    $encrypted_pass = include "PHP/encrypt.php";

    // Execute
    $sql->execute();

    // Password added message
    $message = "Password added!";
    include "PHP/popup_message.php";

  }
  
?>
