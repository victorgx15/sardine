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
        <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#searchFilter">
            <span class="glyphicon glyphicon-search"></span> Filtrer
        </button>
        <script>
            function filterCol(k) {
                var input, filter, table, tr, td, i;
                input = document.getElementById("filterCol"+k.toString());
                filter = input.value.toUpperCase();
                table = document.getElementById("clientTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[k];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
    </div>

    <div class="container" style="width:100% ">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="clientTable">


            <thead>
            <tr>
                <th style="width:10%"; onclick='sortTable(0)' >ID_Produit</th>
                <th style="width:5%"; onclick='sortTable(1)'>Prix</th>
                <th style="width:20%"; onclick='sortTable(2)'>Ref</th>
                <th style="width:20%"; onclick='sortTable(3)'>Nb boites</th>
                <th style="width:15%"; onclick='sortTable(4)'>Poid</th>
                <th style="width:10%"; onclick='sortTable(5)'>Marque</th>
                <th style="width:10%"; onclick='sortTable(6)'>Gamme</th>
                <th style="width:10%"; onclick='sortTable(7)'>Famille</th>
                <th style="width:10%"; onclick='sortTable(8)'>Designation</th>
                <th style="width:10%"; onclick='sortTable(9)'>Description</th>
                <?php
                if($_SESSION['status'] == 'A') {
                    ?>
                <th> Action </th>
                <?php
                }
                ?>
            </tr>
            <tr id="searchFilter" class="collapse">
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol0" onkeyup="ProductList.php"></th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol2" onkeyup="filterCol(1)"></th>
                <th style="text-align:center; word-break:break-all;"> <input style="text-align:center;" type="text" id="filterCol2" onkeyup="filterCol(2)"></th>
                <th style="text-align:center; word-break:break-all; "> <input style="text-align:center;" type="text" id="filterCol3" onkeyup="filterCol(3)"></th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol4" onkeyup="filterCol(4)"> </th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol5" onkeyup="filterCol(5)"></th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol6" onkeyup="filterCol(6)"></th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol7" onkeyup="filterCol(7)"></th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol8" onkeyup="filterCol(8)"></th>
                <?php
/*                if($_SESSION['status'] == 'A') {
                    */?>
                <th style="text-align:center; word-break:break-all; "> </th>
                    <?php
/*                }
                */?>
            </tr>
            </thead>
            <tbody>
            <?php
            $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
            $result = $bdd->prepare("SELECT * FROM produit");
            $result->execute();

            for($i=0; $row = $result->fetch(); $i++){
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
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['Description']; ?></td>
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

    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("clientTable");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc";
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.getElementsByTagName("TR");
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /*check if the two rows should switch place,
                based on the direction, asc or desc:*/
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                //Each time a switch is done, increase this count by 1:
                switchcount ++;
            } else {
                /*If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again.*/
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

</body>
</html>
