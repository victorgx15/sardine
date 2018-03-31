<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
    <title>Retour produit</title>
</head>


<header>
    <?php include "header.php" ?>
    
</header>

<body>

<div class="container" style="padding-left: 10%;padding-right: 10%;">

    <div id="login-form">
        <form method="post" autocomplete="off" id="product_add" action="">

            <div class="col-md-12">

                <div class="form-group" align="center">
                    <h2 class="" align="center">Demander un retour</h2>
                </div>

                <?php

                if (isset($_POST['return_product'])) {
                ?>
                    <div class="form-group">
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo "hey"; ?>
                        </div>
                    </div>
                    <?php
                }

                $id_retour_cmd=$_GET['id_retour_cmd'];
                $id_retour_prdt=$_GET['id_retour_prdt'];
                ?>



                 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="" id="ID_Commande" name="ID_Commande"  class="form-control" placeholder="<?php echo $id_retour_cmd;?>" readonly="readonly" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="" id="ID_Produit" name="ID_Produit"  class="form-control" placeholder="<?php echo $id_retour_prdt;?>"  readonly="readonly" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tags"></span></span>
                        <div align="right" style="display: table-cell;vertical-align:middle;width:90%;height: 40px;">
                            <select  id="Reference" name="Reference"  class="form-control" style="height: 40px;">
                                <option>Emballage abimé</option>
                                <option>Produit non conforme</option>
                                <option>Changement d'avis</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group" >
                    <div class="input-group" style="height: 25%;">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                        <textarea   type="text"  id="Description" name="Description"  style="height: 80px;word-wrap: break-word; word-break: break-all;" class="form-control" required>Description
                        </textarea>
                    </div>
                </div>
               

                <div class="form-group">
                    <button type="submit" class="btn    btn-block btn-primary" name="return_product" id="reg">Retourner le produit</button>
                    <a href="return_product_paper.php"><button type="button" class="btn    btn-block btn-primary" name="return_product" id="reg">Retourner le produit</button></a>
                
                </div>


            </div>

        </form>
    </div>

</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/tos.js"></script>
</body>

<footer>
    <?php include('footer.php');?>
</footer>
</html>
