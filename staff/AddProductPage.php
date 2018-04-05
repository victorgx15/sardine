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

<div class="container">

    <div id="login-form">
        <form method="post" autocomplete="off" id="product_add" action="AddProduct.php" enctype="multipart/form-data">

            <div class="col-md-12">

                <div class="form-group" align="center">
                    <h2 class="" align="center">Ajouter un nouveau produit au catalogue</h2>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="text" id="Designation" name="Designation"  class="form-control" placeholder="Designation" required/>
                    </div>
                </div>

                 <div class="form-group">
                 </div>

                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="text" id="Marque" name="Marque"  class="form-control" placeholder="Marque" required/>
                    </div>
                </div>
                
                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="text" id="Famille" name="Famille"  class="form-control" placeholder="Famille" required/>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-euro"></span></span>
                        <input step="0.01" type="number" id="Prix" name="Prix"  class="form-control" placeholder="Prix" required />
                    </div>
                </div>

                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input step="0.1" type="number" id="Poids" name="Poids"  class="form-control" placeholder="Poids en gramme" required/>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="text" id="Gamme" name="Gamme"  class="form-control" placeholder="Gamme" required />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input type="number"  id="Nombre_boites" name="Nombre_boites"  class="form-control" placeholder="Nombre de boites"
                               required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <input  type="text"  id="Description" name="Description"  class="form-control" placeholder="Description"
                               required/>
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-download-alt"></span></span>
                        <input type="file" id="Url_image" name="Url_image" class="form-control" placeholder="URL de l'image" required/>
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="signup" id="reg">Ajouter le produit</button>
                </div>


            </div>

        </form>
    </div>

</div>





</body>






