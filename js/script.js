// Logout function
document.getElementById("logout_button").addEventListener("click", function(){ //Event listener
  window.location.href='PHP/logout.php';
});

// Toggle between the mobile navigation styling
function nav() {
  var x = document.getElementById("navbar");
  if (x.className === "nav") {
    x.className += " responsive";
  } else {
    x.className = "nav";
  }
}
