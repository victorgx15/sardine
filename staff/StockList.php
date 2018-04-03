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

    </style>
</head>
<body>
<!-- New Client Modal -->


<?php



try {
    ?>

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
                <th style="width:15%">Quantite</th>
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
                            <form class="form-horizontal" method="post" action="AddStorage.php">


                                <div class="modal-footer">
                                    <input type="submit" type="button" class="btn btn-info" value="Confirmer" style="width:80px">
                                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            <?php
            $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
            $storageList = $bdd->prepare("SELECT * FROM emplacement_");
            $storageList->execute();
            while($storage = $storageList->fetch()){
                $Id_Emplacement=$storage['Id_Emplacement'];

                ?>
                <tr>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $storage ['Id_Emplacement']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $storage ['Couloir']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $storage ['Trave']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $storage ['Etagere']; ?></td>
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

                    </td>
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
        $('#stockTable').DataTable( {
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

    });
</script>
</body>
</html>