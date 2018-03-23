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

        table td {
            vertical-align: middle !important;
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
    <div class="container" style="width:80%">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped" id="orderTable">
            <thead>
            <tr>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 15%">ID </th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 25%">Date</th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 25%">Date Livraison</th>
                <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 35%">Etat</th>
            </tr>
            </thead>
            <?php
            $commandesList = $bdd->prepare("SELECT * FROM commande WHERE ID_Client='$ID_Client'");
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
                    <td style="text-align:center; word-break:break-all; width: 25%" class="clickSlide" id="<?php echo $Id_Commande ?>"><?php echo date( "d/m/Y", strtotime($commande['Date'])); ?></td>
                    <form class="form-horizontal orderForm" method="post" id="orderForm<?php echo $Id_Commande; ?>" action="ClientInfo.php?ID_Client=<?php echo $ID_Client;?>">
                        <td style="text-align:center; word-break:break-all; width: 25%" class="clickSlide">
                            <input type="hidden" value="<?php  echo $Id_Commande;?>" id= "Id_Commande" name="Id_Commande">
                            <input readonly ondblclick="onDoubleClick(this.id)" class="form-control Date_Livraison" type="date" value="<?php echo $Date_Livraison; ?>" id="Date_Livraison" name="Date_Livraison" style="text-align:center;">
                        </td>
                        <td style="text-align:center; word-break:break-all; width: 25%" class="clickSlide" >
                            <select class="form-control Etat" name="Etat" id="Etat">
                                <option value="Commande Annulé" <?php if($Etat=='Commande annulé') echo 'selected="selected"';?>>Commande Annulé</option>
                                <option value="Attente de paiement" <?php if($Etat=='Attente de paiement') echo 'selected="selected"';?>>Attente de paiement</option>
                                <option value="En cours de préparation" <?php if($Etat=='En cours de préparation') echo 'selected="selected"';?>>En cours de préparation</option>
                                <option value="Prêt à livrer" <?php if($Etat=='Prêt à livrer') echo 'selected="selected"';?>>Prêt à livrer</option>
                                <option value="Prise en charge par le transporteur" <?php if($Etat=='Prise en charge par le transporteur') echo 'selected="selected"';?>>Prise en charge par le transporteur</option>
                                <option value="En attente de réception" <?php if($Etat=='En attente de réception') echo 'selected="selected"';?>>En attente de réception</option>
                                <option value="Commande livré" <?php if($Etat=='Commande livré') echo 'selected="selected"';?>>Commande livré</option>
                            </select>
                        </td>
                    </form>
                </tr>

            <div class="modal fade" id="orderDetails<?php  echo $Id_Commande;?>" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" text-align="center">Commande N°<?php echo $Id_Commande;?></h4>
                        </div>
                        <div class="modal-body">
                            teststsetsetts
                        </div>
                    </div>
                </div>
            </div>
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
        $('#orderTable').DataTable( {
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
    function format(value) {
        return '<div>Hidden Value: ' + value + '</div>';
    }

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
