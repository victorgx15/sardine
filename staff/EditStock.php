
<?php
    require_once 'dbconnect.php';
    $i=0;
    foreach ($_POST['Id_Produit'] as $Id_Produit){
        foreach($_POST['Id_Emplacement'] as $Id_Emplacement){
            $Quantite_stock=$_POST['Quantite_stock'][$i];
            if($Quantite_stock>0){
                $checkExistence=$bdd->prepare("SELECT * FROM est_placer WHERE Id_Emplacement='$Id_Emplacement' AND Id_Produit='$Id_Produit'");
                $checkExistence->execute();
                if( $checkExistence->rowCount() > 0) {
                    if($_POST['addingQuantity'][$i]){
                        $Quantite_stock+=$checkExistence->fetch()['Quantite_stock'];
                    }
                    $query="UPDATE est_placer SET Quantite_stock='$Quantite_stock' WHERE Id_Emplacement='$Id_Emplacement' AND Id_Produit='$Id_Produit'";
                }else{
                    $query="INSERT INTO est_placer(Id_Emplacement, Id_Produit, Quantite_Stock) VALUES('$Id_Emplacement','$Id_Produit','$Quantite_stock')";
                }
            }else{
                $query="DELETE FROM est_placer WHERE Id_Emplacement='$Id_Emplacement' AND Id_Produit='$Id_Produit'";
            }
            $updateStock=$bdd->prepare($query);
            $updateStock->execute();
            $i++;
        }
    }

    $prevPage=$_SERVER['HTTP_REFERER'];
    echo "<script>alert('Stock modifié avec succès'); window.location.href='$prevPage'; window.location('$prevPage')</script>";
?>

