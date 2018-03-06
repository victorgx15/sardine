
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['Email'])) {
        // Insertion
        $Civilite=$_POST['Civilite'];
        $PRENOM=$_POST['PRENOM'];
        $Nom=$_POST['Nom'];
        $Tel=$_POST['Tel'];
        $Email=$_POST['Email'];
        $Password=hash('sha256', $_POST['Password']);

        $query="INSERT INTO compte(Civilite, PRENOM, Nom, Tel, Email, Password, Status) VALUES('$Civilite', '$PRENOM', '$Nom', '$Tel', '$Email', '$Password','E')";

        $stmt = $bdd->prepare($query);

        $stmt->execute();
        echo "<script>alert('Employé enregistré avec succès');window.location('StaffList.php')</script>";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$bdd = null;

?>