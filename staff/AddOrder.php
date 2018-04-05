
<?php
    require_once 'dbconnect.php';
    $Date=date("Y-m-d");
    $Date_Livraison=date("Y-m-d", strtotime($Date. ' + 3 days'));
    $Etat='Attente de paiement';
    $ID_Client=$_GET['ID_Client'];

    $addOrder = $bdd->prepare("INSERT INTO commande(Date, Date_Livraison, Etat, ID_Client) VALUES('$Date', '$Date_Livraison','$Etat','$ID_Client')");
    $addOrder->execute();

    $Id_Commande=$bdd->lastInsertId();
    foreach ($_POST['Id_Produit'] as $ind => $Id_Produit){
        $Quantite=$_POST['Quantite'][$ind];
            if($Quantite>0){
                $checkExistence=$bdd->prepare("SELECT * FROM lignecommande WHERE Id_Commande='$Id_Commande' AND Id_Produit='$Id_Produit'");
                $checkExistence->execute();
                if( $checkExistence->rowCount() > 0) {
                    $Quantite+=$checkExistence->fetch()['Quantite'];
                    $query="UPDATE lignecommande SET Quantite='$Quantite' WHERE Id_Commande='$Id_Commande' AND Id_Produit='$Id_Produit'";
                }else{
                    $query="INSERT INTO lignecommande(Quantite, Id_Commande, Id_Produit) VALUES('$Quantite','$Id_Commande','$Id_Produit')";
                }

                $addOrder = $bdd->prepare($query);
                $addOrder->execute();
            }
    }
    $link='ClientOrderHistory.php?ID_Client='.$ID_Client;
    echo "<script>alert('Commande passé avec succès');window.location.href='$link';window.location('$link');</script>";

?>

