<?php
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
$get_id=$_GET['id'];

$query = $bdd->prepare("DELETE FROM compte WHERE ID_Client = '$get_id'");
$query->execute();
$query= $bdd->prepare("DELETE FROM adresse WHERE ID_Client='$get_id'");
$query->execute();

$prevPage=$_SERVER['HTTP_REFERER'];
echo "<script>alert('Compte supprimé avec succès'); window.location.href='$prevPage'; window.location('$prevPage')</script>";
?>