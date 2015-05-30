<?php

$host = "195.178.235.60";
$dbname = "ae5929";
$user = "ae5929";
$pass = "Applikationer1";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

if($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

echo "<small>Status: Connected successfully</small>";

?>