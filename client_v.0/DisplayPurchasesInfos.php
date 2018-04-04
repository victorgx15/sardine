<head>
    <style>
        .form-horizontal{
            margin-bottom:0em;
        }
        td{
            margin:auto;
            text-align:center;
            word-break:break-all;
        }
        td.clickSlide {
            cursor: pointer;
        }

        table td {
            vertical-align: middle !important;
        }
        div.slider {
            display: none;
        }

        .modal-body {
            overflow-x: auto;
        }

    </style>
</head>

<header>
    <div style="height: 50px">
        <?php include "header.php" ?>
    </div>
</header>


<body>

<div class="container" style="margin-top: 7%">
    


<div class="jumbotron">
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");

    $ID_Client=$_SESSION['user'];
    $query = $bdd->prepare("SELECT * FROM compte WHERE ID_Client='$ID_Client' AND Status='C'");
    $query->execute();
    $client=$query->fetch();
    ?>
    <div align="center">
        <h2>Historique de vos commandes</h2>
        <h3 style="color:#ad0510"><?php echo $client ['PRENOM']." ".$client ['Nom'];?></h3><br>
    </div>
    <div class="container" style="width:80%">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="orderTable">
            <thead>
            <tr>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 15%">Identifiant</th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 25%">Date de commande</th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 25%">Date de livraison prévue</th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 35%">Etat</th>
                <th style="text-align:center;  background-color:#a2a2a2;">Details</th>
            </tr>
            </thead>
            <?php
            $commandesList = $bdd->prepare("SELECT * FROM commande WHERE ID_Client='$ID_Client' ORDER BY Date DESC");
            $commandesList->execute();
            while($commande = $commandesList->fetch()){
            $Id_Commande=$commande['Id_Commande'];
            $Date_Livraison=$commande['Date_Livraison'];
            $Etat=$commande['Etat'];

            if(isset($_POST['Id_Commande'])&&$Id_Commande==$_POST['Id_Commande']){
                $Etat=$_POST['Etat'];
                $Date_Livraison=$_POST['Date_Livraison'];
                $updateStatus=$bdd->prepare("UPDATE commande SET Etat='$Etat', Date_Livraison='$Date_Livraison' WHERE Id_Commande='$Id_Commande'");
                $updateStatus->execute();
            }
            ?>
                <tr>
                    <td style="text-align:center; word-break:break-all; width: 15%" class="clickSlide" data-toggle="modal" data-target="#orderDetails<?php  echo $Id_Commande;?>"><?php echo $commande['Id_Commande']; ?></td>
                    <td style="text-align:center; word-break:break-all; width: 25%" class="clickSlide" data-toggle="modal" data-target="#orderDetails<?php  echo $Id_Commande;?>" id="<?php echo $Id_Commande ?>"><?php echo date( "d/m/Y", strtotime($commande['Date'])); ?></td>
                        <td style="text-align:center; word-break:break-all; width: 25%" class="clickSlide" >
                            <input readonly="readonly"  class="form-control Date_Livraison" type="date" value="<?php echo $Date_Livraison; ?>" id="Date_Livraison<?php  echo $Id_Commande;?>" name="Date_Livraison" style="text-align:center;">
                        </td>
                        <td style="text-align:center; word-break:break-all; width: 25%" class="clickSlide" >
                            <?php echo $commande['Etat']; ?>
                        </td>
                    <td>
                        <div class="tableWrap" style="display:none;">
                            <table style="width:600px; margin: auto; margin-top: 0; margin-bottom:0; background:rgba(255,255,255,0);" class="table">
                                <tbody>
                                <?php
                                $ligneCommandeList = $bdd->prepare("SELECT * FROM lignecommande WHERE Id_Commande='$Id_Commande'");
                                $ligneCommandeList->execute();
                                $orderTotal=0;
                                while($ligneCommande=$ligneCommandeList->fetch()){
                                    $Id_Produit = $ligneCommande['Id_Produit'];
                                    $getProduct=$bdd->prepare("SELECT * FROM produit WHERE ID_Produit='$Id_Produit'");
                                    $getProduct->execute();
                                    $product=$getProduct->fetch();
                                    $orderTotal+=$product['Prix']*$ligneCommande['Quantite'];
                                    ?>
                                    <tr id="product<?php echo $Id_Commande?>" class="child">
                                        <td style="text-align:center; word-break:break-all;"><?php echo $ligneCommande['Id_Produit']; ?></td>
                                        <td style="text-align:center; word-break:break-all"><?php echo $product['Designation']; ?></td>
                                        <td style="text-align:center; word-break:break-all;"><?php echo number_format($product['Prix'],'2')."€"; ?></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr id="product<?php echo $Id_Commande?>" class="child">
                                    <td style="text-align:center; word-break:break-all;" colspan="3"></td>
                                    <td style="text-align:center; word-break:break-all;" ><?php echo number_format($orderTotal,'2')."€"; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$commandesList = $bdd->prepare("SELECT * FROM commande WHERE ID_Client='$ID_Client'");
$commandesList->execute();
while($commande = $commandesList->fetch()){
$Id_Commande=$commande['Id_Commande'];
$Date_Livraison=$commande['Date_Livraison'];
$Etat=$commande['Etat'];
?>
<div class="modal fade" id="orderDetails<?php  echo $Id_Commande;?>" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" text-align="center">Commande N°<?php echo $Id_Commande;?></h4>
            </div>
            <div class="modal-body">
                <table style=" margin: auto; margin-top: 0; margin-bottom:0; background:rgba(255,255,255,0);" class="table">
                    <thead>
                    <tr id="product<?php echo $Id_Commande?>" class="child">
                        <th style="text-align:center; word-break:break-all;">ID</th>
                        <th style="text-align:center; word-break:break-all;">Désignation</th>
                        <th style="text-align:center; word-break:break-all;">Qté</th>
                        <th style="text-align:center; word-break:break-all;">Prix</th>
                        <th style="text-align:center; word-break:break-all;">Retour</th>
                    
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ligneCommandeList = $bdd->prepare("SELECT * FROM lignecommande WHERE Id_Commande='$Id_Commande'");
                    $ligneCommandeList->execute();
                    $orderTotal=0;
                    while($ligneCommande=$ligneCommandeList->fetch()){
                        $Id_Produit = $ligneCommande['Id_Produit'];
                        $getProduct=$bdd->prepare("SELECT * FROM produit WHERE ID_Produit='$Id_Produit'");
                        $getProduct->execute();
                        $product=$getProduct->fetch();
                        $orderTotal+=$product['Prix']*$ligneCommande['Quantite'];
                        ?>
                        <tr id="product<?php echo $Id_Commande?>" class="child">
                            <td style="text-align:center; word-break:break-all;"><?php echo $ligneCommande['Id_Produit']; ?></td>
                            <td style="text-align:center; word-break:break-all; font-size: 12;" ><?php echo $product['Designation']; ?></td>
                            <td style="text-align:center; word-break:break-all;"><?php echo $ligneCommande['Quantite']; ?></td>
                            <td style="text-align:center; word-break:break-all;"><?php echo number_format($product['Prix'],'2')."€"; ?></td>
                            <td style="text-align:center; word-break:break-all;">
                                <a href="return_product.php?id_retour_cmd=<?php echo $ligneCommande['Id_Commande'];?>&id_retour_prdt=<?php echo $ligneCommande['Id_Produit'];?>"><span class="glyphicon glyphicon-barcode"></span></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr id="product<?php echo $Id_Commande?>" class="child">
                        <td style="text-align:center; word-break:break-all;" colspan="4"></td>
                        <td style="text-align:center; word-break:break-all;" ><?php echo number_format($orderTotal,'2')."€"; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
}
?>
</div>

</body>
<script>

    $(document).ready(function () {
        $('#orderTable').DataTable( {
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
        $("input").on("blur", function() {
            $(this).prop('readonly', true);
            this.form.submit();
        })

        function onDoubleClick(id) {
            var element = $('#' + id);
            if (element.prop('readonly') == true) {
                element.prop('readonly', false);
            }
        }

    });

    $(function() {
        $(".Etat").change(function() {
            this.form.submit();
        });

        $(".Etat").change(function() {
            this.form.submit();
        });

    });

    $("input").on("blur", function() {
        $(this).prop('readonly', true);
        this.form.submit();
    })

    function onDoubleClick(id) {
        var element = $('#' + id);
        if (element.prop('readonly') == true) {
            element.prop('readonly', false);
        }
    }

</script>
