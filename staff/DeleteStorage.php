<?php
require_once 'dbconnect.php';
$get_id=$_GET['id'];
// sql to delete a record
$query= $bdd->prepare("DELETE FROM emplacement_ WHERE Id_Emplacement = '$get_id'");
$query->execute();
header('location:StockList.php');
?>