<?php
  // PHP to decrypt passwords
  
  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

  // Store the cipher method
  $ciphering = "AES-128-CTR";
  $options = 0;

  // Non-NULL Initialization Vector for decryption
  $decryption_iv = '1234567891011121';

  // Store the decryption key
  $decryption_key = $_SESSION['password'];

  // Use openssl_decrypt() function to decrypt the data
  $decrypted_pass=openssl_decrypt ($temp_pass, $ciphering, $decryption_key, $options, $decryption_iv);

  return $decrypted_pass; // Send back the decrypted password

?>
