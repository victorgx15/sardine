<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        th {
            cursor: pointer;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <br><input class="form-control" id="searchInput" type="text" placeholder="Rechercher..."><br>
    <script>
        $(document).ready(function(){
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#clientTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</div>

<?php



try {

    /*$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT id, civilite, lastName, firstName, telephone, email FROM user ";
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
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="clientTable">
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><i class="icon-user icon-large"></i>&nbsp;Liste des Clients</strong>
        </div>
        <thead>
        <tr>
            <th onclick='sortTable(0)' >Id</th>
            <th onclick='sortTable(1)'>Civilite</th>
            <th onclick='sortTable(2)'>Nom</th>
            <th onclick='sortTable(3)'>Prénom</th>
            <th onclick='sortTable(4)'>Téléphone</th>
            <th onclick='sortTable(5)'>E-mail</th>
            <th> Action </th>
        </tr>
        </thead>
        <tbody>
        <?php
        $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
        $result = $bdd->prepare("SELECT * FROM user ORDER BY id ASC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
            $id=$row['id'];
            ?>
            <tr>
                <td style="text-align:center; word-break:break-all; width:300px;"> <?php echo $row ['id']; ?></td>
                <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['civilite']; ?></td>
                <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['firstName']; ?></td>
                <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['lastName']; ?></td>
                <td style="text-align:center; word-break:break-all; width:200px;"> <?php echo $row ['telephone']; ?></td>
                <td style="text-align:center; word-break:break-all; width:450px;"> <?php echo $row ['email']; ?></td>
                <td style="text-align:center; width:350px;">
                    <a href="#edit<?php echo $id; ?>" data-toggle="modal" class="btn btn-info">Edit</a>
                    <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-danger" >Delete </a>
                </td>

                <!-- Modal -->
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
                                            <label class="control-label col-sm-2" for civilite> Civilité : </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="civilite" id= "civilite" required value=<?php echo $row['civilite']; ?>>
                                            </div>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for firstname> Prenom : </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="firstName" id= "firstName" required value=<?php echo $row['firstName']; ?>>
                                            </div>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for lastname> Nom : </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="lastName" id="lastName" required value=<?php echo $row['lastName']; ?>>
                                            </div>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for telephone> Téléphone : </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="telephone" id="telephone" required value=<?php echo $row['telephone']; ?>>
                                            </div>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for email> E-mail : </label>
                                            <div class="col-sm-4">
                                                <input type="email" class="form-control" name="email" id="email" required value=<?php echo $row['email']; ?>>
                                            </div>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for username> Username : </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="username" id="username" required value=<?php echo $row['username']; ?>>
                                            </div>
                                        </div><br>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for password> Password : </label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="password" id="password" required value=<?php echo $row['password']; ?>>
                                            </div><br><br>

                                        </div>


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




                <div id="delete<?php  echo $id;?>" class="modal fade" role="dialog">
                    <div class="modal-header">
                        <h3 id="myModalLabel">Delete</h3>
                    </div>
                    <div class="modal-body">
                        <p><div style="font-size:larger;" class="alert alert-danger">Etes-vous sûr de vouloir effacer les données de <b style="color:red;"><?php echo $row['firstName']." ".$row['lastName'] ; ?></b> ? <br> Cette action n'est pas réversible</p>
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button class="btn btn-inverse" data-dismiss="modal" >Non</button>
                        <a href="DeleteClient.php<?php echo '?id='.$id; ?>" class="btn btn-danger">Oui</a>


                    </div>
                </div>
                </div>
            </tr>
        <?php } ?>
        </tbody>
    </table>

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
