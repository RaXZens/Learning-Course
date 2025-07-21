<?php
$servername ="202.29.50.41";
$username = "s6513805230";
$password = "sgah4963";
$database="s6513805230";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>