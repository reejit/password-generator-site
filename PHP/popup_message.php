<link rel="stylesheet" type="text/css" src="../CSS/styles.css">

<?php
  // PHP for creating popup messages

  // Creates the div for the message
  echo "<div id='snackbar'> $message </div>"

  error_reporting(0); // Turn of error repoprting

  // Redirects the user to the login page if they aren't logged in
  if (!isset($_SESSION['valid'])) {
    header("Location: ../index.php");
  }

?>

<!-- JavaScript for popup message -->
<script>
  // Get the snackbar DIV
  var x = document.getElementById('snackbar');

  // Add the 'show' class to DIV
  x.className = 'show';

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);
</script>
