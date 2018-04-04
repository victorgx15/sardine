
<?php
    require_once 'dbconnect.php';
    $i=0;
    foreach ($_POST['Id_Produit'] as $Id_Produit){
        foreach($_POST['Id_Emplacement'] as $Id_Emplacement){
            $Quantite_stock=$_POST['Quantite_stock'][$i++];
            if($Quantite_stock>0){
                $updateStock=$bdd->prepare("
                IF EXISTS(SELECT WHERE Id_Emplacement='$Id_Emplacement' AND Id_Produit='$Id_Produit')
                    UPDATE est_placer SET Quantite_stock='$Quantite_stock' WHERE Id_Emplacement='$Id_Emplacement' AND Id_Produit='$Id_Produit'
                ELSE
                    INSERT INTO est_placer(Id_Emplacement,Id_Produit,Quantite_Stock) Values()
                ");
            }else{
                $updateStock=$bdd->prepare("DELETE FROM est_placer WHERE Id_Emplacement='$Id_Emplacement' AND Id_Produit='$Id_Produit'");
            }
            $updateStock->execute();
        }
    }

    $prevPage=$_SERVER['HTTP_REFERER'];
    echo "<script>alert('Stock modifié avec succès'); window.location.href='$prevPage'; window.location('$prevPage')</script>";

?>