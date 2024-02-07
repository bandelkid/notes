<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myNotes";
// Create connection
$link = new mysqli($servername, $username, $password, $database);


// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}


?>