<?php
$dbServerName = "35.232.166.32";
$dbUsername = "cs";
$dbPassword = "compusociedad";
$dbName = "sistemamatricula";

// create connection
$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

// check connection
if ($conn->connect_error) {
    echo $conn->connect_error;
}
mysqli_set_charset($conn,"utf8");
?>
