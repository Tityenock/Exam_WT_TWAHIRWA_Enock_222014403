<?php
$host = "localhost";
$user = "twahirwa";
$pass = "222014403";
$database = "virtualpersonaltraining_platform";

$connection = new mysqli($host, $user, $pass, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>