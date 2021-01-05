<?php
  // PHP to decrypt passwords

  require "header.php"; // Get header.php content

  // Store the cipher method
  $ciphering = "AES-128-CTR";
  $options = 0;

  // Non-NULL Initialization Vector for decryption
  $decryption_iv = '1234567891011121';

  // Store the decryption key
  $decryption_key = "OvbeN7sm";

  // Use openssl_decrypt() function to decrypt the data
  $decrypted_pass=openssl_decrypt ($temp_pass, $ciphering, $decryption_key, $options, $decryption_iv);

  return $decrypted_pass; // Send back the decrypted password
?>
