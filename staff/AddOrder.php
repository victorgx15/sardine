
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $Date=date("Y-m-d");
    $Date_Livraison=date("Y-m-d", strtotime($Date. ' + 3 days'));
    $Etat='En cours de préparation';
    $ID_Client=$_GET['ID_Client'];
    $query="INSERT INTO commande(Date, Date_Livraison, Etat, ID_Client) VALUES('$Date', '$Date_Livraison','$Etat','$ID_Client')";

    $stmt = $bdd->prepare($query);
    $stmt->execute();
    $ID_Commande=$bdd->lastInsertId();

    for($i=0; $i<=$_POST['nbProducts']; $i++){
        $ID_Produit=$_POST['ID_Produit'.$i];
        $Quantite=$_POST['Quantite'.$i];
        if($Quantite==""||$Quantite=="0"){
            continue;
        }
        $query="INSERT INTO lignecommande(Quantite, ID_Commande, ID_Produit) VALUES('$Quantite','$ID_Commande','$ID_Produit')";
        $stmt = $bdd->prepare($query);
        $stmt->execute();
    }
    echo "<script>alert('Commande passé avec succès');window.location.href='ClientList.php';window.location('ClientList.php');</script>";
    //header('Location: ClientList.php');

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$bdd = null;

?>