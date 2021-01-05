// PASSWORD GENERATION SCRIPT

// 1. Get the characters for the parameters specified
function getCharacters() {
  var characters = ""; // 1.1 assign characters variable

  // 1.2 Get value of upper case:
  if (document.getElementById("upper").checked === true) {
    characters += "ABCDFEGHIJKLMNOPQRSTUVWXYZ"; // 1.2.1
  }

  // 1.3 Get value of lower case:
  if (document.getElementById("lower").checked === true) {
    characters += "abcdefghijklmnopqrstuvwxyz"; // 1.3.1
  }

  // 1.4 Get value of numbers:
  if (document.getElementById("numbers").checked === true) {
    characters += "0123456789"; // 1.4.1
  }

  // 1.5 Get value of special characters:
  if (document.getElementById("special").checked === true) {
    characters += "!\"#$%&'()*+,-./:;<=>?@[\\]^_`{|}~"; // 1.5.1
  }

  // 1.6 Return string of characters to be used
  return characters;
}

// 2. Javascript function to generate password
document.getElementById("generate").addEventListener("click", function() { // 2.1 Event listener
  var characters = getCharacters(); // 2.2 Get characters
  var passLength = document.getElementById("length").value; // 2.3 Get length

  var password = "";

  // 2.4 Validation for empty options
  if (characters !== "") {
    // Clear warning
    document.getElementById("warning").style.display="none";

    // 2.5 Generate password
    for (i = 0; i < passLength; i++) {
      var random = Math.floor(Math.random() * characters.length);
      password += characters[random];
    }

    // 2.6 Display password
    document.getElementById("passwordOutput").value=password;
    document.getElementById("save_button").style.display="inline-block";
    document.getElementById("password_field").value=document.getElementById("passwordOutput").value;
  } else {
    // 2.4.1 Display warning message
    document.getElementById("passwordOutput").value="";
    document.getElementById("warning").style.display="block";
  }
});

// JAVASCRIPT FUNCTIONS AND EVENT LISTENERS

// 3. Copy function
document.getElementById("copy").addEventListener("click", function(){ // 3.1 Event listener
  // 3.2 Gets text to copy
  var copyText = document.getElementById("passwordOutput");
  copyText.select();

  // 3.3 Copies text to clipboard
  document.execCommand("copy");
});

// 4. Clear function
document.getElementById("clear").addEventListener("click", function(){ // 4.1 Event listener
  // 4.2 Set the value of the password field to nothing
  document.getElementById("passwordOutput").value="";

  // 4.3 Hide other buttons
  document.getElementById("save_button").style.display="none";
  document.getElementById("save_form").style.display="none";
  document.getElementById("cancel_button").style.display="none";
});

// 5. Save function
document.getElementById("save_button").addEventListener("click", function(){ // 5.1 Event listener

  // 5.2 Display the save form
  document.getElementById("save_form").style.display="block";

  // 5.3 Show the cancel button
  document.getElementById("cancel_button").style.display="inline-block";

  //5.4 Fill in the password field of the save form to the generated password
  document.getElementById("password_field").value=document.getElementById("passwordOutput").value;

  window.scroll(0, 1000);
});

// 6. Cancel function
document.getElementById("cancel_button").addEventListener("click", function(){ // 6.1 Event listener
  // 6.2 Hide the save form
  document.getElementById("save_form").style.display="none";

  // 6.3 Hide the cancel button
  document.getElementById("cancel_button").style.display="none";
});
