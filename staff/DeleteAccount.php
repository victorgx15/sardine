<?php
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
$get_id=$_GET['id'];
// sql to delete a record
$query = "Delete from compte where ID_Client = '$get_id'";
$bdd->exec($query);
$query= "DELETE FROM adresse where ID_Client='$get_id'";
$bdd->exec($query);
$prevPage=$_SERVER['HTTP_REFERER'];
echo "<script>alert('Compte supprimé avec succès'); window.location.href='$prevPage'; window.location('$prevPage')</script>";
?>