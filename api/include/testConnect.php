<?php
$host = "sql300.freevnn.com";
$user = "freev_20075840";
$password = "12345678";
$dbName = "freev_20075840_queue_system";

// Create connection
$conn = new mysqli($host, $user, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>