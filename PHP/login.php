<?php
  // PHP code for checking the master password (logging in)

  error_reporting(0); // Turns off error reporting

  // If the login button is pressed and the password field isn't empty, verify password
  if (isset($_POST['login']) && !empty($_POST['master_password'])) {

    // Password hash. Password is hashed so that it is not stored in plain text
    $password_hash = rtrim(file_get_contents("password_hash.txt"));

    // Get password from form
    $password = $_POST["master_password"];

    // Hash password from form
    $attempt_hash = hash("sha256",$password);

    // Compare hashes
    if ($attempt_hash == $password_hash) {

      // The hashes match, so the password is correct
      $_SESSION['valid'] = true; // Sets the $_SESSION['valid'] variable (logs user in)
      $_SESSION['timeout'] = time();
      $_SESSION['password'] = $password; // Saves the password so that it can be used to decrypt passwords

      header('Refresh: 0;'); // Refreshes the page

    } else {
      // Password is incorrect
      // Display password incorrect message

      $message = "Password incorrect!";
      include "PHP/popup_message.php";

    }

  }

?>
