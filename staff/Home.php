
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
        <link rel="stylesheet" href="css/style_Card.css">

        <link rel="stylesheet" href="staff.css" />
    </head>

    <body>
    <div class="jumbotron" style="text-align: center; width=100%">
        <br><h1>Bienvenue</h1>

        <div class="container" style="padding: 10px; display:inline;">

        <div class="container" style="  width: 95%;max-width: 100%;margin: 0 auto;">
          <div class="row text-center"  style="padding-bottom: 30px;">
            <?php
            if(isset($_SESSION['status'])){
                if($_SESSION['status'] == 'A') {

            ?>

                <div class="col-md-3 col-sm-6">
                    <div class="card card-1">
                      <div id="layer">
                        <a href="StaffList.php" > <button id="comprar">Gestion des employés</button></a>
                      </div>
                    </div>
                </div>

            <?php
                }
            }
            ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card card-2">
                      <div id="layer">
                        <a href="ClientList.php" ><button id="comprar">Gestion des clients</button></a>
                      </div>
                    </div>
                </div>



                <div class="col-md-3 col-sm-6">
                    <div class="card card-4">
                      <div id="layer">
                        <a href="StockList.php"><button id="comprar">Gestion des stocks</button></a>
                      </div>
                    </div>            
              </div>

                <div class="col-md-3 col-sm-6">
                    <div class="card card-3">
                      <div id="layer">
                        <a href="ProductList.php" type="button" ><button id="comprar">Gestion de produits</button></a>
                      </div>
                    </div>            
              </div>
              <!-- /.row -->
        </div>            
        </div>


        </div>
    </div>

    </body>
</html
        }