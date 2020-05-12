<?php
  // PHP to add a password to the database

  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

  // If the form is submitted, save the password
  if(isset($_POST["submit"])){

    if (!empty($_POST["name"]) && !empty($_POST["password"])) {

      // Get name and password from form
      $new_name = $_POST["name"];
      $new_username = $_POST["username"];
      $new_password = $_POST["password"];

      // Prevent special characters disturbing SQL
      $new_name = filter_var($new_name, FILTER_SANITIZE_STRING);
      $new_username = filter_var($new_username, FILTER_SANITIZE_STRING);

      // Encrypt the password before saving to database
      $encrypted_pass = include "PHP/encrypt.php";

      // SQL to insert into database
      $sql = "INSERT INTO passwords (id,name,username,password) VALUES(NULL,'$new_name','$new_username','$encrypted_pass')";
      $result = $mysqli->query($sql) or die(mysqli_error($mysqli));

      // Create popup message: "Password added!"
      $message = "Password added!";
      include "PHP/popup_message.php";

    } else {
      // Create popup message: "Please fill out all fields"
      $message = "Please fill out all fields";
      include "PHP/popup_message.php";
    }
  }
?>
