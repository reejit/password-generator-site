<link rel="stylesheet" type="text/css" src="../CSS/styles.css">

<?php
  // Creates the div for the message
  echo "<div id='popup'> $message </div>";
?>

<!-- JavaScript for popup message -->
<script>
  // Get the snackbar DIV
  var x = document.getElementById('popup');

  // Add the 'show' class to DIV
  x.className = 'show';

  if (localStorage.getItem("dark") == 1) {
    document.getElementById('popup').classList.add("invert");
  }

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);
</script>
