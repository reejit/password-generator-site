<?php
  // PHP for encrypting password

  require "header.php"; // Get header.php content

  // Store the cipher method
  $ciphering = "AES-128-CTR";

  // Use OpenSSl Encryption method
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0;

  // Initialization Vector for encryption
  $encryption_iv = '1234567891011121';

  // Store the encryption key
  $encryption_key = "OvbeN7sm";

  // Use openssl_encrypt() function to encrypt the data
  $encrypted_pass = openssl_encrypt($new_password, $ciphering, $encryption_key, $options, $encryption_iv);

  return $encrypted_pass; // Send back the encrypted password

?>
