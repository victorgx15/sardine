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
        <a href="AddStock.php" class="btn btn-success" role="button">
            <span class="glyphicon glyphicon-plus"></span>Ajouter stock
        </a>
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
                <th style="width:5%"; onclick='sortTable(1)'>ID_Boutique</th>
                <th style="width:15%"; onclick='sortTable(2)'>Designation</th>
                <th style="width:10%"; onclick='sortTable(3)'>Quantite</th>
            </tr>
            <tr id="searchFilter" class="collapse">
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol0" onkeyup="ProductList.php"></th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol2" onkeyup="filterCol(1)"></th>
                <th style="text-align:center; word-break:break-all;"> <input style="text-align:center;" type="text" id="filterCol2" onkeyup="filterCol(2)"></th>
                <th style="text-align:center; word-break:break-all; "> <input style="text-align:center;" type="text" id="filterCol3" onkeyup="filterCol(3)"></th>
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
            $result = $bdd->prepare("SELECT pb.pid, pb.bid, p.designation, pb.quantite FROM produitboutique pb, produit p WHERE pb.pid = p.ID_produit");
            $result->execute();

            for($i=0; $row = $result->fetch(); $i++){
                ?>
                <tr>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['pid']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['bid']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['designation']; ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php echo $row ['quantite']; ?></td>

                   
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
