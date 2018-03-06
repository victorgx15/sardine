
<?php
try {
    $bdd = new PDO('mysql$host=localhost;dbname=db;charset=utf8', 'root', '');

    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $designation = $_POST['designation'];
    $marque = $_POST['brand'];
    $famille = $_POST['family'];
    $gamme = $_POST['range'];
    $poids = $_POST['weight'];
    $nombre_boites = $_POST['boxes'];
    $destination = $_POST['destination'];
    $prix = $_POST['price'];
    $url_image = $_POST['img_url'];
    $description = $_POST['description'];
    $ref = $_POST['ref'];

    $query="UPDATE produit SET designation='$designation', marque='$marque', famille='$famille', gamme='$gamme', poids='$poids', nombreè'$nombre_boites', '$destination', '$prix', '$url_image', '$description', '$ref')";

    $stmt = $bdd->prepare($query);

    $stmt->execute();

    echo "<script>alert('Produit modifié avec succès');</script>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
header("Location: ProductList.php");
$bdd = null;

?>