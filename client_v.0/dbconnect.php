<?php

$db_host = "localhost";
$db_name = "db";
$db_user = "root";
$db_pass = "";


$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
$conn->set_charset("utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

