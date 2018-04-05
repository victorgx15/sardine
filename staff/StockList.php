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

        table td {
            vertical-align: middle !important;
        }

        .grid-container {
            margin:5%;
            grid-column-gap: 50px;
            grid-row-gap: 10px;
            display: grid;
            grid-template-columns: repeat(<?php echo $nbCols?>, 1fr);
            grid-auto-rows: 1fr;
        }

        .grid-item {
            background-color: rgba(202, 216, 229, 0.8);
            padding: 5px;
            text-align: center;
        }

        .grid-child{
            display: grid;
            grid-template-columns: auto;
            grid-auto-rows:1fr;
            grid-row-gap: 2px;

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
<div id="test">?</div>
<table id="ProductList" hidden>
    <?php
    $query = $bdd->prepare("SELECT * FROM produit");
    $query->execute();

    while($product = $query->fetch()){
        ?>
        <tr id="<?php echo $product ['Id_Produit']; ?>">
            <td class="productInfo"> <?php echo $product ['Designation']; ?></td>
        </tr>
        <?php
    }
    ?>
</table>

<div class="grid-container" id="storage">
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
                $stored=0;

            ?>
                <!-- Storage location details -->
                <div id="details<?php  echo $Id_Emplacement;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" text-align="center">Produits à l'emplacement <?php

                                    echo join('-', str_split(sprintf( '%06d',$shelf ['Id_Emplacement']), 2));
                                //echo $storage ['Id_Emplacement']; ?></h4>
                            </div>
                            <form class="form-horizontal orderForm" method="post" id="modifyStock<?php echo $Id_Emplacement; ?>" action="EditStock.php">
                                <div class="modal-body" style="padding-bottom: 5px">
                                    <table class="table" id="stockDetails<?php echo $Id_Emplacement; ?>" style="padding:0; margin:0">
                                        <thead>
                                        <tr>
                                            <th style="width:10%"></th>
                                            <th style="width:20%">Id_Produit</th>
                                            <th style="width:60%">Designation</th>
                                            <th style="width:10%">Quantité</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <input type="hidden" value='<?php echo $Id_Emplacement?>' name="Id_Emplacement[]">
                                        <?php
                                        $productList=$bdd->prepare("SELECT * FROM est_placer WHERE Id_Emplacement = '$Id_Emplacement'");
                                        $productList->execute();
                                        while($product=$productList->fetch()){
                                            $stored+=$product["Quantite_stock"];
                                            //Get all Id_Emplacement from est_placer
                                            $Id_Produit=$product['Id_Produit'];
                                            $productInfoList=$bdd->prepare("SELECT * FROM produit WHERE Id_Produit='$Id_Produit'");
                                            $productInfoList->execute();
                                            while($productInfo=$productInfoList->fetch()){
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $product['Id_Produit']?></td>
                                                    <td><?php echo $productInfo['Designation']?></td>
                                                    <td >
                                                        <input type="hidden" value='<?php echo $Id_Produit?>' name="Id_Produit[]">
                                                        <input type="hidden" class="form-control" value="0" name="addingQuantity[]">
                                                        <input type="number" class="form-control stockAmount" value="<?php echo $product["Quantite_stock"]?>" min="0" name="Quantite_stock[]">
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm addRow"  id="addRow<?php echo $Id_Emplacement?>"><span class="glyphicon glyphicon-plus"></span></button>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-info confirm" value="Confirmer" style="width:20%">
                                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="grid-child-item" title="<?php echo join('-', str_split(sprintf( '%06d',$shelf ['Id_Emplacement']), 2)); ?>" data-toggle="modal" data-target="#details<?php  echo $Id_Emplacement;?>" <?php $opacity=0.05+$stored/40; echo "style='background-color: rgba(62, 67, 71, ".$opacity.");'"?>><?php echo join('-', str_split(sprintf( '%06d',$shelf ['Id_Emplacement']), 2)); ?></div>
            <?php
            }
            ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>
</body>
<script>


    $(".addRow").on('click', function(){
        $(this).closest('table').find('tbody')
            .append($('<tr>')
                .append($('<td>')
                    .append($("<button type=\"button\" class='btn btn-danger btn-xs btn-circle deleteBtn'><span class='glyphicon glyphicon-remove'></span></button>")
                    )
                )
                .append($('<td>')
                    .append($("<input type=\"number\" class=\"form-control idField\" value='0' name=\"Id_Produit[]\" style=\"text-align: center\">")
                    )
                )
                .append($('<td class="productInfo">')
                )
                .append($('<td>')
                    .append($("<input type=\"number\" class=\"form-control\" value=\"0\" min=\"0\" name=\"Quantite_stock[]\">")
                    )
                    .append($("<input type=\"hidden\" class=\"form-control\" value=\"1\" name=\"addingQuantity[]\">")
                    )
                )
            );

        var test=true;
        $(this).closest("table").find(".idField").each(function(){
            if($("#" + this.value).length){
                $(this).closest('tr').children('.productInfo').text($("#" + this.value).children('.productInfo').text());
            }else{
                $(this).closest('tr').children('.productInfo').text("Cette référence de produit n'existe pas");
                test=false;
            }
        });
        $(this).closest("form").find(".confirm").prop('disabled', !test);

        $(".idField").on('input', function () {
            var test=true;
            $(this).closest("table").find(".idField").each(function(){
                if($("#" + this.value).length){
                    $(this).closest('tr').children('.productInfo').text($("#" + this.value).children('.productInfo').text());

                }else{
                    $(this).closest('tr').children('.productInfo').text("Cette référence de produit n'existe pas");
                    test=false;
                }
            });
            $(this).closest("form").find(".confirm").prop('disabled', !test);
        });

    });

    $('tbody').on('click', 'button', function () {
        $(this).closest('tr').remove();
    });




</script>

</html>