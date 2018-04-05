<?php

    require_once 'dbconnect.php';
    $emptyTable=$bdd->prepare("TRUNCATE TABLE emplacement_ ");
    $emptyTable->execute();

    for($i=0;$i<$_POST['Couloir'];$i++){
        for($j=0;$j<$_POST['Trave'];$j++){
            for($k=0;$k<$_POST['Etagere'];$k++){
                $Couloir = $i;
                $Trave = $j;
                $Etagere = $k;
                $Id_Emplacement=(int)(sprintf( '%02d',$i).sprintf( '%02d',$j).sprintf( '%02d',$k));
                $addStorage = $bdd->prepare("INSERT INTO emplacement_(Id_Emplacement, Couloir, Trave, Etagere) VALUES('$Id_Emplacement','$Couloir', '$Trave', '$Etagere')");
                $addStorage->execute();
            }
        }
    }


    echo "<script>alert('Entrepot modifié avec succès');window.location.href='StockList.php';window.location('StockList.php')</script>";



?>