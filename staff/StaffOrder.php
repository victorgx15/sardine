<head>
    <?php include "header.php" ?>
    <style>
        td{
            padding: 3px;
            padding-right: 5px;
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
    <h2>Passer une commande pour le client: </h2>
    <h4 style="color:#ad0510"><?php echo $client ['PRENOM']." ".$client ['Nom'];?></h4><br>
    <div class="container" align="left">
        <button class="btn btn-success" onClick="addRow()" ><span class="glyphicon glyphicon-plus"></span> Ajouter un produit</button>
    </div>

<form id="OrderForm" name="OrderForm" method="post" action="AddOrder.php?ID_Client=<?php echo $ID_Client;?>">
    <table id="OrderFormTable" name="OrderFormTable" class="form" style="width:40%;">
        <input id="nbProducts" name="nbProducts" type="number" hidden value="0">
        <tr>
            <td style="width:40%; "><input type="text" id="ID_Produit0" name="ID_Produit0" class="form-control" placeholder="ID Produit"></td>
            <td style="width:5%"><input type="number" id="Quantite0" name="Quantite0" class="form-control" placeholder="0"></td>
            <!--            <td style="width:1%"><button class="btn btn-danger" onClick="removeRow(value)" value="0"><span class="glyphicon glyphicon-remove" id="x"></span></button> </td>-->

        </tr>
    </table>
    <div class="container" align="right">
        <button type="submit" class="btn btn-info" form="OrderForm" value="PasserCommander">Passer la Commande</button>
    </div>
</form>





</div>
</body>
<script>
    var idProd=0;

    function addRow() {
        idProd++;
        document.getElementById('nbProducts').setAttribute('value',idProd.toString());
        var table = document.getElementById('OrderFormTable');
        var rowCount = table.rows.length;
        var row = table.insertRow(rowCount);
        var colCount = table.rows[0].cells.length;
        var newcell = row.insertCell(0);
        var input=document.createElement('INPUT');
        input.type="text";
        input.id="ID_Produit"+idProd.toString();
        input.name="ID_Produit"+idProd.toString();
        input.placeholder="ID Produit";
        input.className="form-control";
        newcell.appendChild(input);

        var newcell = row.insertCell(1);
        var input=document.createElement('INPUT');
        input.type="number";
        input.id="Quantite"+idProd.toString();
        input.name="Quantite"+idProd.toString();
        input.placeholder="0";
        input.className="form-control";
        newcell.appendChild(input);

        /*var newcell = row.insertCell(2);
        var input=document.createElement('BUTTON');
        input.value=idProd;
        input.name="Remove"+idProd.toString();
        input.id="Remove"+idProd.toString();
        input.className="btn btn-danger";

        newcell.appendChild(input);*/


    }

    function removeRow(row){
        document.getElementById('OrderFormTable').deleteRow(row);
    }

    function passOrder(){
        window.location.href = "AddOrder.php?total=" + idProd.toString();
    }

</script>
