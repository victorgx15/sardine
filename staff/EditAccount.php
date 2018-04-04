<?php
    session_start();
    require_once 'dbconnect.php';
    $get_id=$_POST['id'];

    $Status=$_POST['Status'];
    $Civilite=$_POST['Civilite'];
    $PRENOM=ucfirst(strtolower($_POST['PRENOM']));
    $Nom=strtoupper($_POST['Nom']);
    $Tel=$_POST['Tel'];
    $Email=$_POST['Email'];

    if($get_id==$_SESSION['id']){
        $_SESSION['PRENOM']=$PRENOM;
        $_SESSION['Nom']=$Nom;
    }

    $Autorisation='N';
    if (isset($_POST['Autorisation'])&&$_POST['Autorisation'] == 'Y'){
        $Autorisation='Y';
    }
    if(!isset($_POST['Password'])||$_POST['Password']=='') {
        $Password = $_POST['Password_def'];
    }else{
        $Password=hash('sha256', $_POST['Password']);
    }

    $query="UPDATE compte SET Civilite='$Civilite', PRENOM='$PRENOM', Nom='$Nom', Tel='$Tel', Email='$Email', Password='$Password', Status='$Status', Autorisation='$Autorisation' WHERE ID_Client = '$get_id'";
    $stmt=$bdd->prepare($query);
    $stmt->execute();

    if(isset($_POST['Adresse'])&&isset($_POST['Postal_Code'])&&isset($_POST['Ville'])){
        $Adresse=$_POST['Adresse'];
        $Postal_Code=$_POST['Postal_Code'];
        $Ville=$_POST['Ville'];
        $Pays=$_POST['Pays'];
        $query="UPDATE adresse SET Adresse='$Adresse', Postal_Code='$Postal_Code', Ville= '$Ville', Pays='$Pays' WHERE Id_Client= '$get_id' ";
        $stmt=$bdd->prepare($query);
        $stmt->execute();
    }


    $prevPage=$_SERVER['HTTP_REFERER'];

    if(substr($prevPage,-6)=="Edit=1"){
        $prevPage=substr_replace($prevPage,"Edit=0", -6);
    }
    echo "<script>alert('Compte modifié avec succès'); window.location.href='$prevPage'; window.location('$prevPage')</script>";


?>
