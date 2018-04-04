
<?php
    require_once 'dbconnect.php';
    $Date=date("Y-m-d");
    $Date_Livraison=date("Y-m-d", strtotime($Date. ' + 3 days'));
    $Etat='Attente de paiement';
    $ID_Client=$_GET['ID_Client'];
    $stmt = $bdd->prepare("INSERT INTO commande(Date, Date_Livraison, Etat, ID_Client) VALUES('$Date', '$Date_Livraison','$Etat','$ID_Client')");
    $stmt->execute();

    $ID_Commande=$bdd->lastInsertId();
    $emptyCommande=true;

    for($i=0; $i<=$_POST['nbProducts']; $i++){
        if(!isset($_POST['ID_Produit'.$i])||!isset($_POST['Quantite'.$i])){
            continue;
        }

        $ID_Produit=$_POST['ID_Produit'.$i];
        $Quantite=$_POST['Quantite'.$i];


        $checkProduct=$bdd->prepare("SELECT ID_Produit from produit where ID_Produit = '$ID_Produit'");
        $checkProduct->execute();

        if($Quantite==""||$Quantite=="0"||$checkProduct->rowCount()<1){
            continue;
        }

        $emptyCommande=false;
        $stmt = $bdd->prepare("INSERT INTO lignecommande(Quantite, ID_Commande, ID_Produit) VALUES('$Quantite','$ID_Commande','$ID_Produit')");
        $stmt->execute();
    }
    if($emptyCommande){
        $stmt=$bdd->prepare("DELETE FROM commande WHERE ID_Commande='$ID_Commande'");
    }
    echo "<script>alert('Commande passé avec succès');window.location.href='ClientList.php';window.location('ClientList.php');</script>";

