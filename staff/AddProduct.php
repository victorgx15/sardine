<?php

    require_once 'dbconnect.php';
    $Designation = $_POST['Designation'];
    $Marque = $_POST['Marque'];
    $Famille = $_POST['Famille'];
    $Gamme = $_POST['Gamme'];
    $Poids = $_POST['Poids'];
    $Nombre_boites = $_POST['Nombre_boites'];
    $Prix = floatval($_POST['Prix']);
    $Url_image = "";
    $Ref = $_POST['Reference'];
    $Description = $_POST['Description'];

    $query="INSERT INTO produit(Designation, Marque, Famille, Gamme, Url_image, Poids, Nombre_boites, Prix, Description, Ref) VALUES('$Designation', '$Marque', '$Famille', '$Gamme', '$Url_image','$Poids', '$Nombre_boites', '$Prix', '$Description', '$Ref')";

    $stmt = $bdd->prepare($query);
    $stmt->execute();
    $Id_Produit=$bdd->lastInsertId();

    $target_dir="images/Produits/".$Famille."/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$target_file = $target_dir.$Ref."_".$Id_Produit.".jpg";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (copy($_FILES["Url_image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["Url_image"]["name"]). " has been uploaded to ".$target_file;
        echo "<script>alert('Produit ajouté avec succès');window.location.href='ProductList.php'; window.location('ProductList.php');</script>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//echo "<script>alert('Produit ajouté avec succès');window.location.href='ProductList.php'; window.location('ProductList.php');</script>";



?>