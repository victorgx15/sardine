
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
    </head>

    <body>
    <div class="jumbotron" style="text-align: center; width=100%">
        <br><h1>Bienvenue</h1>

        <div class="container" style="padding: 10px; display:inline;">

            <?php
            if(isset($_SESSION['status'])){
                if($_SESSION['status'] == 'A') {

            ?>
                    <a href="StaffList.php" type="button" style="padding:20px; margin-right:20px; width:20%;" class="btn btn-lg btn-danger">Gestion des employés</a>
            <?php
                }
            }
            ?>
            <a href="ClientList.php" type="button" style="padding:20px; margin-right:10px; width:20%" class="btn btn-lg btn-success">Gestion des clients</a>
            <a href="ProductList.php" type="button" style="padding:20px; margin-left:10px; width:20%" class="btn btn-lg btn-warning">Gestion de produits</a>
            <a href="StockList.php" type="button" style="padding:20px; margin-left:10px; width:20%" class="btn btn-lg btn-info">Gestion des stocks</a>

        </div>
    </div>

    </body>
</html
        }