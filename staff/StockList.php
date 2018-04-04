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


    <div class="container" style="width:100%; padding-bottom: 10px">
        <br><div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><i class="icon-user icon-large"></i>&nbsp;Liste du stock</strong>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newStorage">
            <span class="glyphicon glyphicon-plus"></span> Nouveau Emplacement
        </button>

    </div>

    <div class="container" style="width:80% ">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped liveFilterList" id="stockTable">

            <thead>
            <tr>
                <th style="width:15%";>ID_Emplacement</th>
                <th style="width:20%">Couloir</th>
                <th style="width:20%">Trave</th>
                <th style="width:20%">Etagere</th>
                <th></th>
                <th style="width:15%">Quantite Stocké</th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            <div class="modal fade" id="newStorage" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" text-align="center">Ajouter un nouveau emplacement</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" method="post" action="AddStorage.php">
                                <div class="form-group" style="margin:0;">
                                    <label class="control-label col-sm-2" for="Couloir">Couloir: </label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control newStorage" value="0" min="0" name="Couloir" id="newCouloir">
                                    </div>
                                </div>
                                <div class="form-group" style="margin:0">
                                    <label class="control-label col-sm-2" for="Trave">Trave: </label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control newStorage" value="0" min="0" name="Trave" id="newTrave">

                                    </div>
                                </div>
                                <div class="form-group" style="margin:0">
                                    <label class="control-label col-sm-2" for="Etagere">Etagere: </label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control newStorage" value="0" min="0" name="Etagere" id="newEtagere">
                                    </div><br><br>
                                </div>
                                <div class="modal-footer">
                                    <p id="testText" style="color:red">Cet emplacement existe déjà</p>
                                    <input type="submit" id="submitForm" type="button" class="btn btn-info" value="Confirmer" style="width:20%" disabled="true">
                                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            require_once 'dbconnect.php';
            $storageList = $bdd->prepare("SELECT * FROM emplacement_");
            $storageList->execute();
            while($storage = $storageList->fetch()){
                $Id_Emplacement=$storage['Id_Emplacement'];

                ?>
                <tr class="storagePlace">
                    <td style="text-align:center; word-break:break-all; "> <?php echo $storage ['Id_Emplacement']; ?></td>
                    <td style="text-align:center; word-break:break-all; " class="Couloir"> <?php echo $storage ['Couloir']; ?></td>
                    <td style="text-align:center; word-break:break-all; " class="Trave"> <?php echo $storage ['Trave']; ?></td>
                    <td style="text-align:center; word-break:break-all; " class="Etagere"> <?php echo $storage ['Etagere']; ?></td>
                    <td>
                        <div class="tableWrap" style="display:none;">
                            <table style="width:600px; margin: auto; margin-top: 0; margin-bottom:0; background:rgba(255,255,255,0);" class="table">
                                <tbody>
                                <?php
                                $storageInfoList = $bdd->prepare("SELECT * FROM est_placer WHERE Id_Emplacement='$Id_Emplacement'");
                                $storageInfoList->execute();
                                $storageTotal=0;
                                while($storageInfo=$storageInfoList->fetch()){
                                    $Id_Produit = $storageInfo['Id_Produit'];
                                    $getProduct=$bdd->prepare("SELECT * FROM produit WHERE ID_Produit='$Id_Produit'");
                                    $getProduct->execute();
                                    $product=$getProduct->fetch();
                                    $storageTotal+=$storageInfo['Quantite_stock']
                                    ?>
                                    <tr id="product<?php echo $Id_Emplacement?>" class="child">
                                        <td style="text-align:center; word-break:break-all;"><?php echo $storageInfo['Id_Produit']; ?></td>
                                        <td style="text-align:center; word-break:break-all"><?php echo $product['Designation']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $storageTotal; ?></td>
                    <td style="text-align:center; word-break:break-all; ">
                        <a href="#details<?php echo $Id_Emplacement; ?>" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span></a>
                        <a href="#delete<?php echo $Id_Emplacement;?>"  data-toggle="modal"  class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span> </a>
                    </td>


                    <!-- Storage Details Modal -->
                    <div id="details<?php  echo $Id_Emplacement;?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" text-align="center">Produits se trouvant à l'emplacement <?php echo $storage ['Id_Emplacement']; ?></h4>
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





                    <!-- Delete Storage Modal -->
                    <div id="delete<?php  echo $Id_Emplacement;?>" class="modal fade" role="dialog">
                        <div class="modal-header">
                            <h3 id="myModalLabel">Delete</h3>
                        </div>
                        <?php if($storageTotal==0){ ?>
                            <div class="modal-body">
                                <p><div style="font-size:larger;" class="alert alert-danger">Etes-vous sûr de vouloir supprimer cet emplacement? <br> Cette action n'est pas réversible</p>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button class="btn btn-inverse" data-dismiss="modal" >Non</button>
                                <a href="DeleteStorage.php<?php echo '?id='.$Id_Emplacement; ?>" class="btn btn-danger">Oui</a>
                            </div>
                        <?php }else{ ?>
                            <div class="modal-body">
                                <p><div style="font-size:larger;" class="alert alert-danger">Attention, cet emplacement est stocké de produits <br> Veuillez supprimer tout les produits de cet emplacement avant de procéder</p>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button class="btn btn-inverse" data-dismiss="modal" >Annuler</button>
                            </div>
                        <?php } ?>
                    </div>




                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>



<script>
    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });



    oTable = $('#stockTable').DataTable( {
        "columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false
            }
        ],
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

    function storageExists(){
        var test=false;

        oTable.rows().every(function(){
            var coul=false;
            var trav=false;
            var etag=false;
            if(this.data()[1]==$('#newCouloir').val()){
                coul=true
            }
            if(this.data()[2]==$('#newTrave').val()){

                trav=true
            }
            if(this.data()[3]==$('#newEtagere').val().toString()){
                etag=true
            }



            if(coul&&trav&&etag){
                test=true;
                return false;
            }
        });
        return test;
    };
    
    $(document).ready(function () {


        var test=storageExists();
        $("#submitForm").prop('disabled', test)
        if(test){
            $('#testText').show();
        }else{
            $('#testText').hide();
        }



    });

    $(".newStorage").on('input', function () {
        if($(this).val()<0){
            $(this).val(0);
        }
        var test=storageExists();
        $("#submitForm").prop('disabled', test)
        if(test){
            $('#testText').show();
        }else{
            $('#testText').hide();
        }
    });




</script>
</body>
</html>