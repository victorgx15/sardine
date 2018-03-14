
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['Email'])) {
        // Insertion
        $Status=$_POST['Status'];
        $Civilite=$_POST['Civilite'];
        $PRENOM=$_POST['PRENOM'];
        $Nom=$_POST['Nom'];
        $Tel=$_POST['Tel'];
        $Email=$_POST['Email'];
        $Password=hash('sha256', $_POST['Password']);

        $query="INSERT INTO compte(Civilite, PRENOM, Nom, Tel, Email, Password, Status) VALUES('$Civilite', '$PRENOM', '$Nom', '$Tel', '$Email', '$Password','$Status')";
        $newAccount = $bdd->prepare($query);
        $newAccount->execute();
        $ID_Client=$bdd->lastInsertId();

        $Adresse=$_POST['Adresse'];
        $Postal_Code=$_POST['Postal_Code'];
        $Ville=$_POST['Ville'];
        $Pays=$_POST['Pays'];

        $query="INSERT INTO adresse(ID_Client, Adresse, Postal_Code, Ville, Pays, Status) VALUES('$ID_Client','$Adresse', '$Postal_Code', '$Ville', '$Pays', 'C')";
        $newAddress = $bdd->prepare($query);
        $newAddress->execute();
        if($Status=='C'){
            echo "<script>alert('Client enregistré avec succès'); window.location.href='ClientList.php'; window.location('ClientList.php')</script>";
        }else{
            echo "<script>alert('Employé enregistré avec succès'); window.location.href='StaffList.php'; window.location('StaffList.php')</script>";

        }
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$bdd = null;

?>