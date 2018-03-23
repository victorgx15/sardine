<?php
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
$get_id=$_GET['id'];
// sql to delete a record
$query = "DELETE FROM produit WHERE ID_Produit = '$get_id'";
$bdd->exec($query);
header('location:ProductList.php');
?>