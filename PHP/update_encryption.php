<?php
  // PHP for re-encrypting the passwords to the new master password

  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

  include "connect_db.php"; // Connects to database

  // Runs through every password in the database
  $sql = "SELECT * FROM passwords";
  $result = $mysqli->query($sql) or die(mysqli_error($mysqli));

  echo $result->num_rows;

  // If there's a response from SQL statement
  if ($result->num_rows > 0) {

      // for each row
      while($row = $result->fetch_assoc()) {
        // Get variables from database
        $temp_pass = $row["password"];
        $current_id = $row["id"];

        // DECRYPT PASSWORD

        // Store the cipher method
        $ciphering = "AES-128-CTR";
        $options = 0;

        // Non-NULL Initialization Vector for decryption
        $decryption_iv = '1234567891011121';

        // Use openssl_decrypt() function to decrypt the data
        $decrypted_pass=openssl_decrypt ($temp_pass, $ciphering, $master_password, $options, $decryption_iv);

        // ENCRYPT PASSWORD

        // Use OpenSSl Encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);

        // Non-NULL Initialization Vector for encryption
        $encryption_iv = '1234567891011121';

        // Use openssl_encrypt() function to encrypt the data
        $new_encrypted_pass = openssl_encrypt($decrypted_pass, $ciphering, $new_password, $options, $encryption_iv);

        // SQL to insert into database
        $sql_update = "UPDATE passwords SET password = '$new_encrypted_pass' WHERE id = $current_id;";
        $update_result = $mysqli->query($sql_update) or die(mysqli_error($mysqli));

      }
  }

  // Display passwords updated message
  $message = "Passwords updated!";
  include "PHP/popup_message.php";

?>
