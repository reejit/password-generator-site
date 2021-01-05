# Password Generator Web App

## Overview

Web app to create, save and manage passwords.

Programmed in HTML, CSS, JavaScript and PHP.

I used XAMPP (a virtual machine web server) to host the files while I made it.

## Features
### Password storage
The web app saves passwords to a MySQL database having first encrypted them (AES-256 encryption) using the master password (used to unlock the web app) as the encryption key. 

Update: now supports multiple users.

### Multiple Accounts
#### Login/Register
New users can be created from the "Register" page, which is accessed from the index (login) page. Once a user has an account they can log in with their username and passwords.

#### Master Passwords
Each account has a master password, which is saved in a database table as a hash (using SHA-256). This means that users' passwords aren't saved anywhere in plain text. The master password can be changed in the "Account Details" page. 
Once the master password has been used to log the user in, the users' passwords are decrypted and displayed.

### Managing passwords
Passwords can be edited and deleted.
When the passwords are displayed there are individual buttons to copy the username, password and URL.
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
Comes with a page where you can manually add a password with a name, username (optionanl), URL (optional) and the password. Passwords saved without usernames and/or URLs will display "No username set" or "No URL set" respectively when displayed. 

### Changing account details
A new page has been added which allows users to change their master passwords and also toggle a dark mode, which is set on all pages of the site.

## Setting up
### Database
The passwordmanager.sql file is an SQL dump file so that you can import the database into your web server.
