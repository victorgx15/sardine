<!DOCTYPE html>
<?php
// Sous WAMP (Windows)
// Will be changed to correspond to proper database later
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
?>
<html>
    <head>
        <?php include('header.php'); ?>

        <style>
            * {box-sizing: border-box;}
            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>
        <link rel="stylesheet" href="staff.css" />
        <title>La vieille sardine : Accueil Intranet</title>
    </head>

    <body>
    <div class="jumbotron" style="text-align: center; width=100%">
        <br><h1>Bienvenue</h1>
        <div class="container" style="padding: 10px; display:inline;">
            <a href="ClientList.php" type="button" style="padding:20px; margin-right:10px;" class="btn btn-lg btn-success">Gestion comptes clients</a>
            <a href="ClientList.php" type="button" style="padding:20px; margin-left:10px;" class="btn btn-lg btn-warning">Gestion de stock</a>

        </div>
    </div>

    </body>
</html