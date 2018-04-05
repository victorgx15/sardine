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

<?php
require_once 'dbconnect.php';
$Id_Produit=$_GET['id'];
$productList=$bdd->prepare("SELECT * FROM produit WHERE Id_Produit='$Id_Produit'");
$productList->execute();
while($productInfo=$productList->fetch()){
?>

<div class="container">
    <div id="login-form">
        <form method="post" autocomplete="off" id="product_add" action="EditProduct.php" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $Id_Produit;?>" name="Id_Produit">
            <div class="col-md-12">

                <div class="form-group" align="center">
                    <h2 class="" align="center">Modifier le produit <?php echo $Id_Produit?> </h2>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="text" id="Designation" name="Designation"  class="form-control" value="<?php echo $productInfo['Designation']?>" required/>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="text" id="Marque" name="Marque"  class="form-control" value="<?php echo $productInfo['Marque']?>" required/>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="text" id="Famille" name="Famille"  class="form-control" value="<?php echo $productInfo['Famille']?>" required/>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
                        <input step="0.01" type="number" id="Prix" name="Prix"  class="form-control" value="<?php echo $productInfo['Prix']?>" required />
                    </div>
                </div>

                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input step="0.1" type="number" id="Poids" name="Poids"  class="form-control" value="<?php echo $productInfo['Poids']?>" required/>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="text" id="Gamme" name="Gamme"  class="form-control" value="<?php echo $productInfo['Gamme']?>" required />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></span>
                        <div align="right" style="display: table-cell;vertical-align:middle;width:90%;">
                            <select  id="Ref" name="Ref"  class="form-control" style="height: 40px;">
                                <option>Conserves_Thon</option>
                                <option>Conserves_Sardine</option>
                                <option>Conserves_Maquereau</option>
                                <option>Plats_thon</option>
                                <option>Plats_sardine</option>
                                <option>Plats_maquereau</option>
                                <option>Coffrets_thon</option>
                                <option>Coffrets_sardine</option>
                                <option>Coffrets_maquereau</option>
                                <option>Coffrets_multiples</option>
                                <option>Nouveauté</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="number"  id="Nombre_boites" name="Nombre_boites"  class="form-control" value="<?php echo $productInfo['Nombre_boites']?>" required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input  type="text"  id="Description" name="Description"  class="form-control" value="<?php echo $productInfo['Description']?>" required/>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-download-alt"></span></span>
                        <input type="file" id="Url_image" name="Url_image" class="form-control" value="<?php echo $productInfo['Url_Image']?>" required/>
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn    btn-block btn-primary" name="signup" id="reg">Modifier le produit</button>
                </div>


            </div>

        </form>
    </div>

</div>
<?php
}
?>




</body>






