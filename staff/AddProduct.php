<head>
    <?php include "header.php" ?>
    <style>
        td{
            padding:4px;
            vertical-align:top;
            width:50%
        }
        input {
            display:table-cell;
            width:100%
        }

    </style>
</head>

<body>
<div class="jumbotron" align="center">
    <h2>Nouveau produit</h2><br>
    <form method="post" id="product_add" action="AddProduct.php">
        <table style="width:60%" >
            <tr>
                <td><input type="text" name="Designation" placeholder="Designation" required></td>
                <td><input type="text" name="Marqe" placeholder="Marque" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Famille" placeholder="Famille" required></td>
                <td><input type="text" name="Gamme" placeholder="Gamme" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Ref" placeholder="Reference" required></td>
                <td><input type="text" name="price" placeholder="Prix en euros" required></td>
            </tr>
            <tr>
                <td><input type="text" name="Poids" placeholder="Poids en gramme" required></td>
                <td><input type="text" name="Nombre_boites" placeholder="Nombre de boites" required></td>
            </tr>
            <tr>
                <td>URL de l'image<input id="url_img" type="file" name="Url_Image"></td>
                <td><textarea  name="Description" form="product_add" placeholder="Description..." cols="45"></textarea></td>
            </tr>

        </table>
        <br><input type="submit" value="Confirmer" class="btn btn-success" style="text-align: center;">

    </form>

</div>
</body>






<?php
if(isset($_POST['Designation'])&&isset($_POST['Marque'])&&isset($_POST['Famille'])&&isset($_POST['Gamme'])&&isset($_POST['Poids'])&&isset($_POST['Nombre_boites'])&&isset($_POST['Prix'])){
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $designation = $_POST['Designation'];
            $marque = $_POST['Marque'];
            $famille = $_POST['Famille'];
            $gamme = $_POST['Gamme'];
            $poids = $_POST['Poids'];
            $nombre_boites = $_POST['Nombre_boites'];
            $prix = $_POST['Prix'];
            $url_image = $_POST['Url_Image'];
            $ref = $_POST['Ref'];
            $description = $_POST['Description'];

            $query="INSERT INTO produit(Designation, Marque, Famille, Gamme, Poids, Nombre_boites, Prix, Url_Image, Description, Ref) VALUES('$designation', '$marque', '$famille', '$gamme', '$poids', '$nombre_boites', '$prix', '$url_image', '$description', '$ref')";

            $stmt = $bdd->prepare($query);

            $stmt->execute();
            echo "<script>alert('Produit ajouté avec succès');windows.location='ProductList.php'</script>";

    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $bdd = null;
}


?>