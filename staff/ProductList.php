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
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="clientTable">


            <thead>
            <tr>
                <th style="width:10%";>ID_Produit</th>
                <th style="width:5%";>Prix</th>
                <th style="width:20%";>Ref</th>
                <th style="width:20%";>Nb boites</th>
                <th style="width:15%";>Poid</th>
                <th style="width:10%";>Marque</th>
                <th style="width:10%";>Gamme</th>
                <th style="width:10%";>Famille</th>
                <th style="width:10%";>Designation</th>
                <th style="width:10%";>Description</th>
                <?php
                if($_SESSION['status'] == 'A') {
                    ?>
                <th> Action </th>
                <?php
                }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
            $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
            $result = $bdd->prepare("SELECT * FROM produit");
            $result->execute();

            while($row = $result->fetch()){
                $id=$row['Id_Produit'];
                ?>
                <tr>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Id_Produit']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo number_format($row ['Prix'],'2'); ?>€</td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Ref']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Nombre_boites']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Poids']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Marque']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Gamme']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Famille']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Designation']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php if(strlen($row ['Description'])>50){echo substr($row ['Description'], 0, 50)."...";}else{echo $row ['Description'];}/*display the first 50 char of desc*/?></td> 
                    <?php
                        if($_SESSION['status'] == 'A') {
                    ?>
                    <td style="text-align:center; word-break:break-all; ">
                        <a href="#edit<?php echo $id; ?>" data-toggle="modal" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span> </a>
                    </td>
                    <?php
                        }
                    ?>

                    <!-- Delete Product Modal -->
                    <div id="delete<?php  echo $id;?>" class="modal fade" role="dialog">
                        <div class="modal-header">
                            <h3 id="myModalLabel">Delete</h3>
                        </div>
                        <div class="modal-body">
                            <p><div style="font-size:larger;" class="alert alert-danger">Etes-vous sûr de vouloir supprimer le produit <b style="color:red;"><?php echo $row['Designation']; ?></b> ? <br> Cette action n'est pas réversible</p>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-inverse" data-dismiss="modal" >Non</button>
                            <a href="DeleteProduct.php<?php echo '?id='.$id; ?>" class="btn btn-danger">Oui</a>


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
        var oTable = $('table').DataTable( {
            select: true,
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
