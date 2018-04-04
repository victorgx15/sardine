<?php

$db_host = "localhost";
$db_name = "db";
$db_user = "root";
$db_pass = "";

try {
    $bdd = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_user, $db_pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {

    echo "Error: " . $e->getMessage();
}
?>

