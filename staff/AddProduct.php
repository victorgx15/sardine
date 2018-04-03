<?php
//if(isset($_POST['Designation'])&&isset($_POST['Marque'])&&isset($_POST['Famille'])&&isset($_POST['Gamme'])&&isset($_POST['Poids'])&&isset($_POST['Nombre_boites'])&&isset($_POST['Prix'])){
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $Designation = $_POST['Designation'];
        $Marque = $_POST['Marque'];
        $Famille = $_POST['Famille'];
        $Gamme = $_POST['Gamme'];
        $Poids = $_POST['Poids'];
        $Nombre_boites = $_POST['Nombre_boites'];
        $Prix = floatval($_POST['Prix']);
        if(isset($_POST['Url_Image'])){
            $Url_image = $_POST['Url_Image'];
            copy($Url_image.toString(), '/images/Produit');
        }
        $Ref = $_POST['Reference'];
        $Description = $_POST['Description'];

        $query="INSERT INTO produit(Designation, Marque, Famille, Gamme, Poids, Nombre_boites, Prix, Url_Image, Description, Ref) 
VALUES('$Designation', '$Marque', '$Famille', '$Gamme', '$Poids', '$Nombre_boites', '$Prix', '$Url_image', '$Description', '$Ref')";

        $stmt = $bdd->prepare($query);

        $stmt->execute();
        echo "<script>alert('Produit ajouté avec succès');window.location.href='ProductList.php';window.location('ProductList.php')</script>";

    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $bdd = null;
//}


?>