<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php'); ?>
    <style>
        th {
            cursor: pointer;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">


</div>

<?php



try {

    /*$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT id, civilite, Nom, PRENOM, Tel, Email FROM user ";
    $stmt = $bdd->prepare($query);
    $stmt->execute();



    echo "<table class='table table-striped table-bordered table-hover' id='clientTable'>";
//A déterminer quels informations du client sont importants de display
    echo "<tr><th onclick='sortTable(0)' >Id</th><th onclick='sortTable(1)'>Civilite</th><th onclick='sortTable(2)'>Nom</th><th onclick='sortTable(3)'>Prénom</th><th onclick='sortTable(4)'>Téléphone</th><th onclick='sortTable(5)'>E-mail</th><th> Action </th></tr>";

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        $id=$row['id'];
        foreach($row as $value) {
            echo "<td>{$value}</td>";
        }
        echo "<td> <a href='#editClient<?php echo $id;?>'  data-toggle='modal'  class='btn btn-info' >Modifier </a>              <input type='button' class='btn btn-danger btn-xs' value='Supprimer'></td>";
        include 'modal_EditClient.php';
        echo "</tr>";
    }
    echo "</table>";*/
    ?>
    <div class="container" style="width:1800px; padding-bottom: 10px">
        <br><div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><i class="icon-user icon-large"></i>&nbsp;Liste des Clients</strong>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newClient">
            <span class="glyphicon glyphicon-plus"></span> Nouveau Client
        </button>
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

    <div class="container" style="width:1800px ">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="clientTable">


            <thead>
            <tr>
                <th onclick='sortTable(0)' >ID_Client</th>
                <th onclick='sortTable(1)'>Civilite</th>
                <th onclick='sortTable(2)'>Prenom</th>
                <th onclick='sortTable(3)'>Nom</th>
                <th onclick='sortTable(4)'>Tel</th>
                <th onclick='sortTable(5)'>Email</th>

                <th> Action </th>
            </tr>
            <tr id="searchFilter" class="collapse">
                <th style="text-align:center; word-break:break-all; width:200px;"><input style="text-align:center;" type="text" id="filterCol0" onkeyup="filterCol(0)"></th>
                <th style="text-align:center; word-break:break-all; width:50px;"> </th>
                <th style="text-align:center; word-break:break-all; width:200px;"> <input style="text-align:center;" type="text" id="filterCol2" onkeyup="filterCol(2)"></th>
                <th style="text-align:center; word-break:break-all; width:200px;"> <input style="text-align:center;" type="text" id="filterCol3" onkeyup="filterCol(3)"></th>
                <th style="text-align:center; word-break:break-all; width:200px;"><input style="text-align:center;" type="text" id="filterCol4" onkeyup="filterCol(4)"> </th>
                <th style="text-align:center; word-break:break-all; width:200px;"><input style="text-align:center;" type="text" id="filterCol5" onkeyup="filterCol(5)"></th>
                <th style="text-align:center; word-break:break-all; width:100px;"> </th>
            </tr>
            </thead>
            <tbody>
            <?php
            $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
            $result = $bdd->prepare("SELECT * FROM compte WHERE Status='C' ");
            $result->execute();

            for($i=0; $row = $result->fetch(); $i++){
                $id=$row['ID_Client'];
                ?>
                <tr>
                    <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['ID_Client']; ?></td>
                    <td style="text-align:center; word-break:break-all; width:50px;"> <?php echo $row ['Civilite']; ?></td>
                    <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['PRENOM']; ?></td>
                    <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['Nom']; ?></td>
                    <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['Tel']; ?></td>
                    <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['Email']; ?></td>
                    <td style="text-align:center; word-break:break-all; width:100px;">
                        <a href="#edit<?php echo $id; ?>" data-toggle="modal" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span></a>
                        <a href="#edit<?php echo $id; ?>" data-toggle="modal" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span> </a>
                    </td>

                    <!-- New Client Modal -->
                    <div class="modal fade" id="newClient" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" text-align="center">Enregistrer un nouveau client</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post" id="add_client" action="AddClient.php">
                                        <div class="container">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Civilite> Civilité : </label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="Civilite" id="Civilite">
                                                        <option value="M">Monsieur</option>
                                                        <option value="Mme">Madame</option>
                                                    </select>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for PRENOM> Prenom : </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="PRENOM" id= "PRENOM">
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Nom> Nom : </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="Nom" id="Nom" >
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Tel> Téléphone : </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="Tel" id="Tel" >
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Email> E-mail : </label>
                                                <div class="col-sm-4">
                                                    <input type="email" class="form-control" name="Email" id="Email" >
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Password> Mot de passe : </label>
                                                <div class="col-sm-4">
                                                    <input type="password" class="form-control" name="Password" id="Password">
                                                </div>
                                            </div><br><br>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" type="button" class="btn btn-info" value="Confirmer">
                                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- Edit Client Modal -->
                    <div class="modal fade" id="edit<?php  echo $id;?>" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" text-align="center">Modifier un client</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post" id="edit_client" action="EditClient.php">
                                        <div class="container">
                                            <div class="form-group">
                                                <input type="hidden" value="<?php  echo $id;?>" id= "id" name="id" >
                                                <label class="control-label col-sm-2" for Civilite> Civilité : </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="Civilite" id= "Civilite" required value=<?php echo $row['Civilite']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for PRENOM> Prenom : </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="PRENOM" id= "PRENOM" required value=<?php echo $row['PRENOM']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Nom> Nom : </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="Nom" id="Nom" required value=<?php echo $row['Nom']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Tel> Téléphone : </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="Tel" id="Tel" required value=<?php echo $row['Tel']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Email> E-mail : </label>
                                                <div class="col-sm-4">
                                                    <input type="email" class="form-control" name="Email" id="Email" required value=<?php echo $row['Email']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Password> Mot de passe : </label>
                                                <div class="col-sm-4">
                                                    <input type="password" class="form-control" name="Password" id="Password">
                                                    <input type="hidden" class="form-control" name="Password_def" id="Password_def" value=<?php echo $row['Password']; ?>>
                                                </div>
                                            </div><br><br>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" type="button" class="btn btn-info" value="Confirmer">
                                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>



                    <!-- Delete Client Modal -->
                    <div id="delete<?php  echo $id;?>" class="modal fade" role="dialog">
                        <div class="modal-header">
                            <h3 id="myModalLabel">Delete</h3>
                        </div>
                        <div class="modal-body">
                            <p><div style="font-size:larger;" class="alert alert-danger">Etes-vous sûr de vouloir effacer les données de <b style="color:red;"><?php echo $row['PRENOM']." ".$row['Nom'] ; ?></b> ? <br> Cette action n'est pas réversible</p>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-inverse" data-dismiss="modal" >Non</button>
                            <a href="DeleteClient.php<?php echo '?id='.$id; ?>" class="btn btn-danger">Oui</a>


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
