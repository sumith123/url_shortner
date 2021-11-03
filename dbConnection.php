<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shorten_db';
$base_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$short_url='https://abc.com/'; 

// DB connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}