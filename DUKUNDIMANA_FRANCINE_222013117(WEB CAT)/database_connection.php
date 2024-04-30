<?php
$host = "localhost";
$user = "francine";
$pass = "222013117";
$database = "lib_managment";

$connection = new mysqli($host, $user, $pass, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
