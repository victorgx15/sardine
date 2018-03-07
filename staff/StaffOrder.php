<head>
    <?php include "header.php" ?>
    <style>


    </style>
</head>

<body>
<div class="jumbotron" align="center">

    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $id=$_GET['id'];
    $query = $bdd->prepare("SELECT * FROM compte WHERE ID_Client='$id' AND Status='C'");
    $query->execute();
    $client=$query->fetch();
    ?>
    <h2>Passer une commande pour le client: </h2>
    <h3 style="color:red"><?php echo $client ['PRENOM']." ".$client ['Nom'];?></h3>

</div>
</body>






<?php

?>