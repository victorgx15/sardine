<?php

    require_once 'dbconnect.php';
    for($i=0;$i<10;$i++){
        for($j=0;$j<10;$j++){
            for($k=0;$k<5;$k++){
                $Couloir = $i;
                $Trave = $j;
                $Etagere = $k;
                $Id_Emplacement=(int)(sprintf( '%02d',$i).sprintf( '%02d',$j).sprintf( '%02d',$k));
                $stmt = $bdd->prepare("INSERT INTO emplacement_(Id_Emplacement, Couloir, Trave, Etagere) VALUES('$Id_Emplacement','$Couloir', '$Trave', '$Etagere')");
                $stmt->execute();
            }
        }
    }


    echo "<script>alert('Emplacement ajouté avec succès');window.location.href='StockList.php';window.location('StockList.php')</script>";



?>