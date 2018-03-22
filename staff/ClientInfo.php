<head>
    <?php include "header.php" ?>
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

        div.slider {
            display: none;
        }
    </style>
</head>

<body>

<div class="jumbotron">
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $ID_Client=$_GET['ID_Client'];
    $query = $bdd->prepare("SELECT * FROM compte WHERE ID_Client='$ID_Client' AND Status='C'");
    $query->execute();
    $client=$query->fetch();
    ?>
    <div align="center">
        <h2>Commandes du client</h2>
        <h3 style="color:#ad0510"><?php echo $client ['PRENOM']." ".$client ['Nom'];?></h3><br>
    </div>
    <div class="container" style="width:90% ">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="orderList">
            <thead>
            <tr>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 15%">ID </th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 25%">Date</th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 25%">Date Livraison</th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 35%">Etat</th>
            </tr>
            </thead>
            <?php
            $commandesList = $bdd->prepare("SELECT * FROM commande WHERE ID_Client='$ID_Client' ORDER BY Id_Commande DESC");
            $commandesList->execute();
            while($commande = $commandesList->fetch()){
            $Id_Commande=$commande['Id_Commande'];

            if(isset($_POST['Id_Commande'])&&$Id_Commande==$_POST['Id_Commande']){
                $Etat=$_POST['Etat'];
                $updateStatus=$bdd->prepare("UPDATE commande SET Etat='$Etat' WHERE Id_Commande='$Id_Commande'");
                $updateStatus->execute();
            }else{
                $Etat=$commande['Etat'];
            }
            ?>
                <tr>
                    <td style="text-align:center; word-break:break-all; width: 15%" class="clickSlide"><?php echo $commande['Id_Commande']; ?></td>
                    <td style="text-align:center; word-break:break-all; width: 25%" class="clickSlide"><?php echo $commande['Date']; ?></td>
                    <td style="text-align:center; word-break:break-all; width: 25%" class="clickSlide"><?php echo $commande['Date_Livraison']; ?></td>
                    <td style="text-align:center; word-break:break-all; width: 35%" >
                        <form class="form-horizontal" method="post" id="statusForm" action="ClientInfo.php?ID_Client=<?php echo $ID_Client;?>">
                            <input type="hidden" value="<?php  echo $Id_Commande;?>" id= "Id_Commande" name="Id_Commande">
                            <select class="form-control Etat" name="Etat" id="Etat">
                                <option value="Attente de paiement" <?php if($Etat=='Attente de paiement') echo 'selected="selected"';?>>Attente de paiement</option>
                                <option value="En cours de préparation" <?php if($Etat=='En cours de préparation') echo 'selected="selected"';?>>En cours de préparation</option>
                                <option value="Prêt à livrer" <?php if($Etat=='Prêt à livrer') echo 'selected="selected"';?>>Prêt à livrer</option>
                                <option value="Prise en charge par le transporteur" <?php if($Etat=='Prise en charge par le transporteur') echo 'selected="selected"';?>>Prise en charge par le transporteur</option>
                                <option value="En attente de réception" <?php if($Etat=='En attente de réception') echo 'selected="selected"';?>>En attente de réception</option>
                                <option value="Commande livré" <?php if($Etat=='Commande livré') echo 'selected="selected"';?>>Commande livré</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <tr style="padding:0px">
                    <td colspan="4" style="padding:0px;">
                        <div class="tableWrap" style="display:none;">
                            <table style="width:600px; margin: auto; margin-top: 0; margin-bottom:0; background:rgba(255,255,255,0);" class="table">
                                <tbody>
                                <tr id="product<?php echo $Id_Commande?>" class="child">
                                    <td style="text-align:center; word-break:break-all;">ID Produit</td>
                                    <td style="text-align:center; word-break:break-all;">Nom du Produit</td>
                                    <td style="text-align:center; word-break:break-all;">Quantité</td>
                                    <td style="text-align:center; word-break:break-all;">Prix</td>
                                </tr>

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
                                        <td style="text-align:center; word-break:break-all;"><?php echo $ligneCommande['Quantite']; ?></td>
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
                    <td hidden></td>
                    <td hidden></td>
                    <td hidden></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
<script>

    $(document).ready(function () {
        $('table').DataTable( {
            "bSort": false,
            "searching": false,
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

    $(function() {
        $(".Etat").change(function() {
            this.form.submit();
        });
    });

    $(".clickSlide").on('click', function () {
            $(this).parent().next("tr").children().children().slideToggle();
        }
    )


</script>
