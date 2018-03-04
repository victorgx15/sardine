
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['email'])) {
        // Insertion
        $civilite=$_POST['civilite'];

        $username=$_POST['username'];
        $firstName=$_POST['firstName'];
        $lastName=$_POST['lastName'];
        $telephone=$_POST['telephone'];
        $email=$_POST['email'];
        //$password=hash('sha256', $_POST['password']);
        $password=$_POST['password'];

        $query="INSERT INTO user(civilite, username, firstName, lastName, telephone, email, password) VALUES('$civilite', '$username', '$firstName', '$lastName', '$telephone', '$email', '$password')";

        $stmt = $bdd->prepare($query);

        $stmt->execute();
        echo "<script>alert('Client enregistré avec succès');</script>";
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
header("Location: Home.php");
$bdd = null;

?>