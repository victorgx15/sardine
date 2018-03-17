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

<table  style="width:70%;" class="table table-bordered table-hover" id="commandesList">
    <thead>
    <tr>
        <th style="text-align:center; word-break:break-all; background-color:#a2a2a2;">ID </th>
        <th style="text-align:center; word-break:break-all; background-color:#a2a2a2;">Date</th>
        <th style="text-align:center; word-break:break-all; background-color:#a2a2a2;">Date Livraison</th>
        <th style="text-align:center; word-break:break-all; background-color:#a2a2a2;">Etat</th>
    </tr>
    </thead>
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $commandesList = $bdd->prepare("SELECT * FROM commande WHERE ID_Client='$ID_Client'");
    $commandesList->execute();
    while($commande = $commandesList->fetch()){
        $Id_Commande=$commande['Id_Commande'];
    ?>

        <tr class="parent">
            <td style="text-align:center; word-break:break-all;"><?php echo $commande['Id_Commande']; ?></td>
            <td style="text-align:center; word-break:break-all;"><?php echo $commande['Date']; ?></td>
            <td style="text-align:center; word-break:break-all;"><?php echo $commande['Date_Livraison']; ?></td>
            <td style="text-align:center; word-break:break-all;"><?php echo $commande['Etat']; ?></td>
        </tr>
        <tr id="product<?php echo $Id_Commande?>" class="child" style="display:none;">
            <th style="text-align:center; word-break:break-all; background-color:white"></th>
            <th style="text-align:center; word-break:break-all; background-color:white">ID Produit</th>
            <th style="text-align:center; word-break:break-all; background-color:white">Nom du Produit</th>
            <th style="text-align:center; word-break:break-all; background-color:white">Quantité</th>
        </tr>


        <?php
        $ligneCommandeList = $bdd->prepare("SELECT * FROM lignecommande WHERE Id_Commande='$Id_Commande'");
        $ligneCommandeList->execute();
        while($ligneCommande=$ligneCommandeList->fetch()){
            $Id_Produit = $ligneCommande['Id_Produit'];
            $getProductName=$bdd->prepare("SELECT * FROM produit WHERE ID_Produit='$Id_Produit'");
            $getProductName->execute();
            $productName=$getProductName->fetch();
        ?>
            <tr id="product<?php echo $Id_Commande?>" class="child" style="display:none;">
                <td style="text-align:center; word-break:break-all; background-color:white"></td>
                <td style="text-align:center; word-break:break-all; background-color:white"><?php echo $ligneCommande['Id_Produit']; ?></td>
                <td style="text-align:center; word-break:break-all; background-color:white"><?php echo $productName['Designation']; ?></td>
                <td style="text-align:center; word-break:break-all; background-color:white"><?php echo $ligneCommande['Quantite']; ?></td>
            </tr>

    <?php
        }
    }
    ?>
</table>

</div>
</body>
<script>
    $(document).ready(function() {

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
                $(this).slideToggle("slow");
            })
        });

    })
</script>
