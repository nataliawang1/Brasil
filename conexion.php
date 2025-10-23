<?php
$servername = "localhost";
$username = "root";   
$password = "";       
$dbname = "turismobrasil";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
