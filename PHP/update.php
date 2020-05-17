<?php
  // PHP to update password

  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

  // If the form is submitted, save the password
  if(isset($_POST["save"])){


    // Get changed name and password from form
    $new_name = $_POST["changed_name"];
    $new_username = $_POST["changed_username"];
    $new_password = $_POST["changed_password"];
    $id = $_POST["id"];

    // Prevent special characters disturbing SQL
    $new_name = filter_var($new_name, FILTER_SANITIZE_STRING);
    $new_username = filter_var($new_username, FILTER_SANITIZE_STRING);

    // Encrypt the password before saving to database
    $encrypted_pass = include "PHP/encrypt.php";

    // SQL to UPDATE into database
    $sql = "UPDATE passwords SET name = '$new_name', username = '$new_username', password = '$encrypted_pass' WHERE id = '$id'";
    $mysqli->query($sql);

    // Refresh the page
    echo "<script type='text/javascript'>window.top.location='saved_passwords.php';</script>";

  }

?>
