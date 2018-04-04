
<?php

    require_once 'dbconnect.php';

    $designation = $_POST['designation'];
    $marque = $_POST['brand'];
    $famille = $_POST['family'];
    $gamme = $_POST['range'];
    $poids = $_POST['weight'];
    $nombre_boites = $_POST['boxes'];
    $destination = $_POST['destination'];
    $prix = $_POST['price'];
    $url_image = $_POST['img_url'];
    $description = $_POST['description'];
    $ref = $_POST['ref'];

    $query="UPDATE produit SET designation='$designation', marque='$marque', famille='$famille', gamme='$gamme', poids='$poids', nombreè'$nombre_boites', '$destination', '$prix', '$url_image', '$description', '$ref')";

    $stmt = $bdd->prepare($query);

    $stmt->execute();

    echo "<script>alert('Produit modifié avec succès');window.location.href='ProductList.php'; window.location('ProductList.php');</script>";
?>