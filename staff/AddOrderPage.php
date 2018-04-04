<head>
    <?php include "header.php" ?>
    <style>
        td{
            padding: 3px;
            padding-right: 5px;
        }



        .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
        }

        table td {
            vertical-align: middle !important;
        }

        .productInfo {
            text-align: center;
        }



    </style>
</head>

<body>
<div class="jumbotron" align="center">

    <?php
    require_once 'dbconnect.php';
    $ID_Client=$_GET['ID_Client'];
    $query = $bdd->prepare("SELECT * FROM compte WHERE ID_Client='$ID_Client' AND Status='C'");
    $query->execute();
    $client=$query->fetch();
    ?>
    <h2>Passer une commande pour le client: </h2>
    <h3 style="color:#ad0510"><?php echo $client ['PRENOM']." ".$client ['Nom'];?></h3><br>

    <table id="ProductList" hidden>
        <?php
        $query = $bdd->prepare("SELECT * FROM produit");
        $query->execute();

        while($product = $query->fetch()){
        ?>
            <tr id="<?php echo $product ['Id_Produit']; ?>">
                <td class="productInfo"> <?php echo $product ['Designation']; ?></td>
                <td class="productPrice"> <?php echo number_format($product['Prix'],'2')."€"; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<div style="text-align:left; width:80%">
    <button class="btn btn-success"  id="addRow"><span class="glyphicon glyphicon-plus"></span></button>
    <a href="ProductList.php" target="_blank" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Parcourir</a>
</div><br>

<form id="OrderForm" name="OrderForm" method="post" action="AddOrder.php?ID_Client=<?php echo $ID_Client;?>">
    <table id="OrderFormTable" name="OrderFormTable" class="table" style="width:80%; background:transparent;">
        <input id="nbProducts" name="nbProducts" type="number" hidden value="0">
        <tbody>
        <tr id = 0>
            <td style="width:5%">
                <button class="btn btn-danger btn-xs btn-circle deleteBtn"><span class="glyphicon glyphicon-remove"></span></button>
            </td>
            <td style="width:35%; "><input type="text" id="ID_Produit0" name="ID_Produit0" class="form-control idField" placeholder="ID Produit"></td>
            <td style="width:10%"><input type="number" id="Quantite0" name="Quantite0" class="form-control qtField" placeholder="0" min="0"></td>
            <td class="productInfo" style="width:40%;"></td>
            <td class="productPrice" style="width:10%;"></td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5" style="text-align: right" id="orderTotal"></td>
        </tr>
        </tfoot>
    </table><br>
    <div class="container" align="right">
        <button type="submit" class="btn btn-primary " form="OrderForm" value="PasserCommander" id="submitForm" disabled="true">Passer la Commande</button>
    </div>
</form>





</div>
</body>
<script>
    var idProd=0;

    $("#addRow").on('click', function(){
        idProd++;
        $('#nbProducts').val(idProd);
        $("#submitForm").prop('disabled', true);
        $("#OrderFormTable").find('tbody')
            .append($('<tr>')
                .append($('<td style="width:5%">')
                    .append($("<button class='btn btn-danger btn-xs btn-circle deleteBtn'><span class='glyphicon glyphicon-remove'></span></button>")
                    )
                )
                .append($('<td style="width:35%">')
                    .append($("<input type='text' id='ID_Produit"+idProd+"' name='ID_Produit"+idProd+"' class='form-control idField' placeholder='ID Produit'>")
                    )
                )

                .append($('<td style="width:10%">')
                    .append($("<input type='number' id='Quantite"+idProd+"' min='0' name='Quantite"+idProd+"' class='form-control qtField' placeholder='0'>")
                    )
                )
                .append($('<td style="width:40%" class="productInfo">')
                )
                .append($('<td style="width:10%" class="productPrice">')
                )
            );
        $(".idField").on('input', function () {
            $("#submitForm").prop('disabled', !allProductsExist());
        });

        $(".qtField, .idField").on('input', function () {
            if($(this).val()<0){
                $(this).val('');
            }
            updateTotalPrice();
        });
    })


    $('#OrderFormTable').on('click', 'button', function () {
        $(this).closest('tr').remove();
        updateTotalPrice();
    })

    $(".idField").on('input', function () {
        $("#submitForm").prop('disabled', !allProductsExist());
    });

    $(".qtField, .idField").on('input', function () {
        if($(this).val()<0){
            $(this).val('');
        }
        updateTotalPrice();
    });

    function updateTotalPrice(){
        priceArray=[];
        qteArray=[];
        i=0;
        $("#OrderFormTable .productPrice").each(function() {
            var value = $(this).text();
            priceArray[i++]= parseFloat(value);
        });
        i=0;
        $("#OrderFormTable .qtField").each(function() {
            var value = $(this).val();
            qteArray[i++]= parseFloat(value);
        });
        sum=0;
        for(i=0;i<priceArray.length;i++){
            if(isNaN(priceArray[i])||isNaN(qteArray[i])){
                continue;
            }
            sum+=qteArray[i]*priceArray[i];
        }
        $('#orderTotal').text(sum == 0 ? '' : sum.toFixed(2) + "€");
    }

    function allProductsExist(){
        test=true;
        $("#OrderFormTable .idField").each(function(){
            if($("#" + this.value).length){
                $(this).parent().parent().children('.productInfo').text($("#" + this.value).children('.productInfo').text());
                $(this).parent().parent().children('.productPrice').text($("#" + this.value).children('.productPrice').text());
            }else{
                $(this).parent().parent().children('.productInfo').text("Cette référence de produit n'existe pas");
                $(this).parent().parent().children('.productPrice').text("");
                test=false;
            }
        });
        return test;
    }


</script>
