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
                <td><input type="text" id="Designation" name="Designation" placeholder="Designation" required></td>
                <td><input type="text" id="Marque" name="Marque" placeholder="Marque" required></td>
            </tr>
            <tr>
                <td><input type="text" id="Famille" name="Famille" placeholder="Famille" required></td>
                <td><input type="text" id="Gamme" name="Gamme" placeholder="Gamme" required></td>
            </tr>
            <tr>
                <td><input type="text" id="Ref" name="Ref" placeholder="Reference" required></td>
                <td><input type="text" id="Prix" name="Prix" placeholder="Prix" required>.</td>
            </tr>
            <tr>
                <td><input type="text" id="Poids" name="Poids" placeholder="Poids en gramme" required></td>
                <td><input type="number" id="Nombre_boites" name="Nombre_boites" placeholder="Nombre de boites" required></td>
            </tr>
            <tr>
                <td>URL de l'image<input id="Url_img" type="file" name="Url_Image"></td>
                <td><textarea  id="Description" name="Description" form="product_add" placeholder="Description..." cols="45"></textarea></td>
            </tr>

        </table>
        <br><input type="submit" value="Confirmer" class="btn btn-success" style="text-align: center;">

    </form>

</div>
</body>






