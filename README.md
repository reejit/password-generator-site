# Password Generator Web App

## Overview

Web app to create, save and manage passwords.

Programmed in HTML, CSS, JavaScript and PHP.

I used XAMPP (a virtual machine web server) to host the files while I made it.

## Features
### Password storage
The web app saves passwords to a MySQL database having first encrypted them (AES-256 encryption) using the master password (used to unlock the web app) as the encryption key.

### Master password
The master password is stored in the file password_hash.txt and hashed using SHA-256. This is so that the password isn't saved anywhere in plain text, making it (pretty much) impossible to view any passwords from the database in plain text without knowing the master password. 
The master password can be changed on the login page, and this will cause all of the passwords in the database to be re-encrypted with the new master password.

### Managing passwords
Passwords can be edited and deleted.
When the passwords are displayed there are individual buttons to copy the username and password.
The user can search through saved passwords by their name.

### Generating passwords
Comes with a page to generate passwords. Options include:
* Changing the length
* Changing the character set:
  * Upper case 
  * Lower case
  * Numbers
  * Symbols
  
When a password is generated, the user can copy it, clear it or save it. Saving it allows you to save the password with a name and/or a username. Passwords saved without usernames will display "No username set" when displayed.

### Adding passwords
Comes with a page where you can manually add a password with a name and/or username, and the password. Passwords saved without usernames will display "No username set" when displayed. 

## Setting up

The app comes with the default password "password", which can be changed on the login page. 

### Database
The passwordmanager.sql file is an SQL dump file so that you can import the database into your web server.
