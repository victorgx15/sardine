<head>
    <?php include "header.php" ?>
    <style>
        td{
            padding: 10px;
            padding-right: 30px;
        }
        .parent:hover{
            cursor: pointer;
        }
    </style>
</head>

<body>
<div class="jumbotron" align="center">

    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $ID_Client=$_GET['ID_Client'];
    $query = $bdd->prepare("SELECT * FROM compte WHERE ID_Client='$ID_Client' AND Status='C'");
    $query->execute();
    $client=$query->fetch();
    ?>
    <h2>Commandes du client</h2>
    <h3 style="color:#ad0510"><?php echo $client ['PRENOM']." ".$client ['Nom'];?></h3><br>

<table  style="width:70%; margin-bottom:5px" class="table table-bordered table-hover">
    <thead>
    <tr>
        <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 15%">ID </th>
        <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 25%">Date</th>
        <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 25%">Date Livraison</th>
        <th style="text-align:center; word-break:break-all; background-color:#a2a2a2; width: 35%">Etat</th>
    </tr>
    </thead>
</table>
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $commandesList = $bdd->prepare("SELECT * FROM commande WHERE ID_Client='$ID_Client'");
    $commandesList->execute();
    while($commande = $commandesList->fetch()){
        $Id_Commande=$commande['Id_Commande'];
    ?>
    <table  style="width:70%; margin-top: 0; margin-bottom:0; background:whitesmoke" class="table table-bordered table-hover">
        <thead>
        <tr class="parent">
            <td style="text-align:center; word-break:break-all; width: 15%"><?php echo $commande['Id_Commande']; ?></td>
            <td style="text-align:center; word-break:break-all; width: 25%"><?php echo $commande['Date']; ?></td>
            <td style="text-align:center; word-break:break-all; width: 25%"><?php echo $commande['Date_Livraison']; ?></td>
            <td style="text-align:center; word-break:break-all; width: 35%"><?php echo $commande['Etat']; ?></td>
        </tr>
        </thead>
    </table>
        <div class="tableWrap" style="display:none">
            <table  style="width:40%; margin-top: 0; margin-bottom:0;" class="table">
                <tbody>
                <tr id="product<?php echo $Id_Commande?>" class="child">
                    <th style="text-align:center; word-break:break-all;">ID Produit</th>
                    <th style="text-align:center; word-break:break-all;">Nom du Produit</th>
                    <th style="text-align:center; word-break:break-all;">Quantité</th>
                    <th style="text-align:center; word-break:break-all;">Prix</th>
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
                        <td style="text-align:center; word-break:break-all;"><?php echo number_format($product['Prix']*$ligneCommande['Quantite'],'2')."€"; ?></td>

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
        <?php
    }
    ?>
</div>

</body>
<script>
    /*$(document).ready(function() {

        function getChildren($row) {
            var children = [];
            while($row.next().hasClass('child')) {
                children.push($row.next());
                $row = $row.next();
            }
            return children;
        }

        $('.parent').on('click', function() {

            var children = getChildren($(this));
            $.each(children, function() {
                $(this).slideToggle();
            })
        });

    })*/

    $("thead").click(function () {
            $(this).parent().next("div").slideToggle();
        }
    )
</script>
