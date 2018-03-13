<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $get_id=$_POST['id'];
    $Civilite=$_POST['Civilite'];
    $PRENOM=$_POST['PRENOM'];
    $Nom=$_POST['Nom'];
    $Tel=$_POST['Tel'];
    $Email=$_POST['Email'];
    if(!isset($_POST['Password'])||$_POST['Password']=='') {
        $Password = $_POST['Password_def'];
    }else{
        $Password=hash('sha256', $_POST['Password']);
    }

    $query="UPDATE compte SET Civilite='$Civilite', PRENOM='$PRENOM', Nom='$Nom', Tel='$Tel', Email='$Email', Password='$Password' WHERE ID_Client = '$get_id'";
    $bdd->exec($query);
    echo "<script>alert('Client modifié avec succès!'); window.location.href='ClientList.php'; window.location('ClientList.php')</script>";

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$bdd = null;

?>
