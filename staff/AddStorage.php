<?php

    require_once 'dbconnect.php';

    $Couloir = $_POST['Couloir'];
    $Trave = $_POST['Trave'];
    $Etagere = $_POST['Etagere'];

    $stmt = $bdd->prepare("INSERT INTO emplacement_(Couloir, Trave, Etagere) VALUES('$Couloir', '$Trave', '$Etagere')");
    $stmt->execute();

    echo "<script>alert('Emplacement ajouté avec succès');window.location.href='StockList.php';window.location('StockList.php')</script>";



?>