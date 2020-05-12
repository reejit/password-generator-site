// GENERAL SCRIPT

// Logout function
document.getElementById("logout_button").addEventListener("click", function(){ //Event listener
  window.location.href='PHP/logout.php';
});

// Popup message function
function popup_message(message) {
  // Get the snackbar DIV
  var x = document.getElementById('snackbar');
  x.innerHTML=message

  // Add the 'show' class to DIV
  x.className = 'show';

  // After 3 seconds, remove the show class from DIV
  setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);
}
