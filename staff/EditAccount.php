<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $get_id=$_POST['id'];
    $Status=$_POST['Status'];
    $Civilite=$_POST['Civilite'];
    $PRENOM=ucfirst(strtolower($_POST['PRENOM']));
    $Nom=strtoupper($_POST['Nom']);
    $Tel=$_POST['Tel'];
    $Email=$_POST['Email'];
    if(!isset($_POST['Password'])||$_POST['Password']=='') {
        $Password = $_POST['Password_def'];
    }else{
        $Password=hash('sha256', $_POST['Password']);
    }

    $query="UPDATE compte SET Civilite='$Civilite', PRENOM='$PRENOM', Nom='$Nom', Tel='$Tel', Email='$Email', Password='$Password', Status='$Status' WHERE ID_Client = '$get_id'";
    $stmt=$bdd->prepare($query);
    $stmt->execute();


    $Adresse=$_POST['Adresse'];
    $Postal_Code=$_POST['Postal_Code'];
    $Ville=$_POST['Ville'];
    $Pays=$_POST['Pays'];
    $query="UPDATE adresse SET Adresse='$Adresse', Postal_Code='$Postal_Code', Ville= '$Ville', Pays='$Pays' WHERE Id_Client= '$get_id' ";
    $stmt=$bdd->prepare($query);
    $stmt->execute();

    $prevPage=$_SERVER['HTTP_REFERER'];

    if(substr($prevPage,-6)=="Edit=1"){
        $prevPage=substr_replace($prevPage,"Edit=0", -6);
    }
    echo "<script>alert('Compte modifié avec succès'); window.location.href='$prevPage'; window.location('$prevPage')</script>";

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$bdd = null;

?>
