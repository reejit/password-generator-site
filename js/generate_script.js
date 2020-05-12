// PASSWORD GENERATION SCRIPT

// Javascript to get options
function getCharacters() {
  var characters = "";

  // Get value of upper case:
  if (document.getElementById("upper").checked === true) {
    characters += "ABCDFEGHIJKLMNOPQRSTUVWXYZ";
  }

  // Get value of lower case:
  if (document.getElementById("lower").checked === true) {
    characters += "abcdefghijklmnopqrstuvwxyz";
  }

  // Get value of numbers:
  if (document.getElementById("numbers").checked === true) {
    characters += "0123456789";
  }

  // Get value of special characters:
  if (document.getElementById("special").checked === true) {
    characters += "!\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~";
  }

  // Return string of characters to be used
  return characters;
}

// Javascript function to generate password
document.getElementById("generate").addEventListener("click", function() { // Event listener
  // Get character options and password length
  var characters = getCharacters();
  var passLength = document.getElementById("length").value;

  var password = "";

  // Validation for empty options
  if (characters !== "") {
    // Clear warning
    document.getElementById("warning").style.display="none";

    // Generate password
    for (i = 0; i < passLength; i++) {
      var random = Math.floor(Math.random() * characters.length);
      password += characters[random];
    }

    // Display password
    document.getElementById("passwordOutput").value=password;
    document.getElementById("save_button").style.display="inline-block";
    document.getElementById("password_field").value=document.getElementById("passwordOutput").value;
  } else {
    // Display warning message
    document.getElementById("passwordOutput").value="";
    document.getElementById("warning").style.display="block";
  }
});

// JAVASCRIPT FUNCTIONS AND EVENT LISTENERS

// Copy function
document.getElementById("copy").addEventListener("click", function(){ // Event listener
  // Gets text to copy
  var copyText = document.getElementById("passwordOutput");
  copyText.select();

  // Copies text to clipboard
  document.execCommand("copy");
});

// Clear function
document.getElementById("clear").addEventListener("click", function(){ // Event listener
  document.getElementById("passwordOutput").value="";
  document.getElementById("save_button").style.display="none";
  document.getElementById("save_form").style.display="none";
  document.getElementById("cancel_button").style.display="none";
});

// Save function
document.getElementById("save_button").addEventListener("click", function(){ // Event listener
  document.getElementById("save_form").style.display="block";
  document.getElementById("cancel_button").style.display="inline-block";
  document.getElementById("password_field").value=document.getElementById("passwordOutput").value;
});

// Cancel function
document.getElementById("cancel_button").addEventListener("click", function(){ //Event listener
  document.getElementById("save_form").style.display="none";
  document.getElementById("cancel_button").style.display="none";
});
