<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('header.php');
    require_once 'dbconnect.php';

    $getNbCols = $bdd->prepare("SELECT MAX(Couloir) as maxCols FROM emplacement_ ");
    $getNbCols->execute();
    $nbCols=$getNbCols->fetch()['maxCols']+1;
    ?>
    <style>
        th {
            cursor: pointer;
            text-align: center;
        }
        input {
            box-sizing: border-box;
        }

        .mtable {
            display: table;
            border-collapse: collapse;
            width:100%;
        }
        .mrow {
            display: table-row;
            border-bottom: 1px solid rgba(133, 133, 133, 0.74);
            padding:5px;
        }
        .mcell {
            display: table-cell;
            text-align: center;
            padding:5px;
        }
        .mtabhead {
            display: table-header-group;
            font-weight: bold;

        }

        .grid-container {
            margin-left:5%;
            margin-top:5%;
            grid-column-gap: 50px;
            grid-row-gap: 10px;
            display: grid;
            grid-template-columns: repeat(<?php echo $nbCols?>, 100px);
            grid-auto-rows: 100px;
        }

        .grid-item {
            background-color: rgba(202, 216, 229, 0.8);
            padding: 5px;
            text-align: center;
        }

        .grid-child{
            display: grid;
            grid-template-columns: auto;
            grid-auto-rows:17px;
            grid-row-gap: 1px;
        }

        .grid-child-item{
            background-color: rgba(62, 67, 71, 0.1);
        }

        .grid-colhead{
            grid-area: header;
        }



    </style>
</head>
<body>

<div class="grid-container">
    <?php
    $storageList = $bdd->prepare("SELECT *  FROM emplacement_ GROUP BY Couloir,Trave ORDER BY Trave,Couloir");
    $storageList->execute();
    while($storage = $storageList->fetch()){
    ?>

        <div class="grid-item">
            <div class="grid-child">
            <?php
            $col=$storage['Couloir'];
            $row=$storage['Trave'];
            $shelfList=$bdd->prepare("SELECT *  FROM emplacement_ WHERE Couloir='$col' AND Trave='$row'");
            $shelfList->execute();
            while($shelf=$shelfList->fetch()){
                $Id_Emplacement=$shelf['Id_Emplacement'];

            ?>
                <div class="grid-child-item"  data-toggle="modal" data-target="#details<?php  echo $Id_Emplacement;?>"></div>
                <!-- Storage location details -->
                <div id="details<?php  echo $Id_Emplacement;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" text-align="center">Produits se trouvant à l'emplacement <?php

                                    echo join('-', str_split(sprintf( '%06d',$shelf ['Id_Emplacement']), 2));
                                //echo $storage ['Id_Emplacement']; ?></h4>
                            </div>
                            <div class="modal-body">
                                <div class="mtable">
                                    <div class="mtabhead">
                                        <div class="mrow">
                                            <div class="mcell">Id_Produit</div>
                                            <div class="mcell">Designation</div>
                                            <div class="mcell">Quantité</div>
                                        </div>
                                    </div>
                                    <form class="form-horizontal orderForm" method="post" id="modifyStock<?php echo $Id_Emplacement; ?>" action="EditStock.php">
                                        <input type="hidden" value='<?php echo $Id_Emplacement?>' name="Id_Emplacement[]">
                                        <?php
                                        $productList=$bdd->prepare("SELECT * FROM est_placer WHERE Id_Emplacement = '$Id_Emplacement'");
                                        $productList->execute();
                                        while($product=$productList->fetch()){
                                            //Get all Id_Emplacement from est_placer
                                            $Id_Produit=$product['Id_Produit'];
                                            $productInfoList=$bdd->prepare("SELECT * FROM produit WHERE Id_Produit='$Id_Produit'");
                                            $productInfoList->execute();
                                            while($productInfo=$productInfoList->fetch()){
                                                ?>
                                                <div class="mrow">
                                                    <div class="mcell"><?php echo $product['Id_Produit']?></div>
                                                    <div class="mcell"><?php echo $productInfo['Designation']?></div>
                                                    <div class="mcell" style="width:80px">
                                                        <input type="hidden" value='<?php echo $Id_Produit?>' name="Id_Produit[]">
                                                        <input type="number" class="form-control stockAmount" value="<?php echo $product["Quantite_stock"]?>" min="0" name="Quantite_stock[]">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" type="button" class="btn btn-info" value="Confirmer" style="width:20%">
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<script>
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });
</script>
</body>
</html>