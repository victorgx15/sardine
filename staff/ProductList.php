<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php'); ?>
    <style>
        th {
            cursor: pointer;
            text-align: center;
        }
        input {
            width: 80%;
            box-sizing: border-box;
        }
        td{
            white-space: nowrap;
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
    </style>
</head>
<body>

<div class="container">


</div>

<?php



try {
    ?>
    <div class="container" style="width:100%; padding-bottom: 10px">
        <br><div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><i class="icon-user icon-large"></i>&nbsp;Liste des Produits</strong>
        </div>
        <?php
            if($_SESSION['status'] == 'A') {
        ?>
        <a href="AddProductPage.php" class="btn btn-success" role="button">
            <span class="glyphicon glyphicon-plus"></span> Nouveau Produit
        </a>
        <?php
            }
        ?>
    </div>

    <div class="container" style="width:100% ">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="productTable">


            <thead>
            <tr>
                <th style="width:10%";>ID_Produit</th>
                <th style="width:5%";>Prix</th>
                <th style="width:5%";>Quantité Stocké</th>
                <th style="width:10%";>Ref</th>
                <th style="width:5%";>Nb boites</th>
                <th style="width:5%";>Poid</th>
                <th style="width:8%";>Marque</th>
                <th style="width:8%";>Gamme</th>
                <th style="width:8%";>Famille</th>
                <th style="width:20%";>Designation</th>
                <th style="width:10%";>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once 'dbconnect.php';
            $productList = $bdd->prepare("SELECT * FROM produit");
            $productList->execute();

            while($product = $productList->fetch()){
                $Id_Produit=$product['Id_Produit'];
                $stockCount=0;

                $storageList = $bdd->prepare("SELECT * FROM est_placer WHERE Id_Produit=$Id_Produit");
                $storageList->execute();
                ?>
                <!-- Product Location Modal -->
                <div id="details<?php  echo $Id_Produit;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" text-align="center">Emplacements du produit <?php echo $product ['Id_Produit']; ?></h4>
                            </div>
                            <div class="modal-body">
                                <div class="mtable">
                                    <div class="mtabhead">
                                        <div class="mrow">
                                            <div class="mcell">ID_Emplacement</div>
                                            <div class="mcell">Couloir</div>
                                            <div class="mcell">Trave</div>
                                            <div class="mcell">Etagere</div>
                                            <div class="mcell">Quantité</div>
                                        </div>
                                    </div>
                                    <form class="form-horizontal orderForm" method="post" id="modifyStock<?php echo $Id_Produit; ?>" action="EditStock.php">
                                        <input type="hidden" value='<?php echo $Id_Produit?>' name="Id_Produit[]">
                                    <?php
                while($storage=$storageList->fetch()){
                    $Id_Emplacement=$storage["Id_Emplacement"];
                    $stockCount+=$storage['Quantite_stock'];
                    $storageInfoList=$bdd->prepare("SELECT * FROM emplacement_ WHERE Id_Emplacement='$Id_Emplacement'");
                    $storageInfoList->execute();

                    while($storageInfo=$storageInfoList->fetch()){
                    ?>
                        <div class="mrow">
                            <div class="mcell"><?php echo join('-', str_split(sprintf( '%06d',$Id_Emplacement), 2)); ?></div>
                            <div class="mcell"><?php echo $storageInfo['Couloir']?></div>
                            <div class="mcell"><?php echo $storageInfo['Trave']?></div>
                            <div class="mcell"><?php echo $storageInfo['Etagere']?></div>
                            <div class="mcell" style="width:80px">
                                <input type="hidden" value='<?php echo $Id_Emplacement?>' name="Id_Emplacement[]">
                                <input type="hidden" class="form-control" value="0" name="addingQuantity[]">
                                <input type="number" class="form-control stockAmount" value="<?php echo $storage["Quantite_stock"]?>" min="0" name="Quantite_stock[]">
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
                <tr>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $product ['Id_Produit']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo number_format($product ['Prix'],'2'); ?>€</td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $stockCount; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $product ['Ref']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $product ['Nombre_boites']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $product ['Poids']; ?>g</td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $product ['Marque']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $product ['Gamme']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $product ['Famille']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $product ['Designation']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php if(strlen($product ['Description'])>50){echo substr($product ['Description'], 0, 50)."...";}else{echo $product ['Description'];}/*display the first 50 char of desc*/?></td>
                    <td style="text-align:center; word-break:break-all; ">
                        <a href="#details<?php echo $Id_Produit; ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span></a>
                    <?php
                        if($_SESSION['status'] == 'A') {
                    ?>
                        <a href="#edit<?php echo $Id_Produit; ?>" data-toggle="modal" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#delete<?php echo $Id_Produit;?>"  data-toggle="modal"  class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span> </a>

                    <?php
                        }
                    ?>
                    </td>
                    <!-- Delete Product Modal -->
                    <div id="delete<?php  echo $Id_Produit;?>" class="modal fade" role="dialog">
                        <div class="modal-header">
                            <h3 id="myModalLabel">Delete</h3>
                        </div>
                        <div class="modal-body">
                            <p><div style="font-size:larger;" class="alert alert-danger">Etes-vous sûr de vouloir supprimer le produit <b style="color:red;"><?php echo $product['Designation']; ?></b> ? <br> Cette action n'est pas réversible</p>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-inverse" data-dismiss="modal" >Non</button>
                            <a href="DeleteProduct.php<?php echo '?id='.$Id_Produit; ?>" class="btn btn-danger">Oui</a>
                        </div>
                    </div>

                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>


<?php
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$bdd = null;
echo "</table>";
?>

<script>

    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });

    $(document).ready(function () {
        var oTable = $('#productTable').DataTable( {

            "oLanguage": {
                "sProcessing":     "Traitement en cours...",
                "sSearch":         "",
                "sSearchPlaceholder":         "Rechercher",
                "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
                "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
                "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                "sInfoPostFix":    "",
                "sLoadingRecords": "Chargement en cours...",
                "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
                "oPaginate": {
                    "sFirst":      "Premier",
                    "sPrevious":   "Pr&eacute;c&eacute;dent",
                    "sNext":       "Suivant",
                    "sLast":       "Dernier"
                },
                "oAria": {
                    "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                    "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
                }
            }

        });



    });

    $(".stockAmount").on('input', function () {
        if($(this).val()<0){
            $(this).val(0);
        }
    });

</script>

</body>
</html>
