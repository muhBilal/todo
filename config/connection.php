<?php
$host    = 'localhost';
$user    = 'bilal';
$pass    = 'bilal123';
$db_name = 'todo';

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>