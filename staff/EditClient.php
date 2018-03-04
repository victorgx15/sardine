<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $get_id=$_POST['id'];
    $civilite=$_POST['civilite'];
    $username=$_POST['username'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $telephone=$_POST['telephone'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query="UPDATE user SET civilite='$civilite', username='$username', firstName='$firstName', lastName='$lastName', telephone='$telephone', email='$email', password='$password' WHERE id = '$get_id'";
    $bdd->exec($query);
    echo "<script>alert('Client modifié avec succès!'); window.location='ClientList.php'</script>";

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$bdd = null;

?>
