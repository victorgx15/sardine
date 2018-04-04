
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
    </head>

    <body>
    <div class="jumbotron" style="text-align: center; width=100%;">
        <br><h1>Bienvenue</h1>

        <div class="container" style="padding: 10px; display:inline;">

        <div class="container" style="  width: 95%;max-width: 100%;margin: 0 auto;">
          <div class="row text-center"  style="padding-bottom: 30px;">
            <?php
            if(isset($_SESSION['status'])){
                if($_SESSION['status'] == 'A') {

            ?>

                <div class="col-md-3 col-sm-6">
                    <a href="StaffList.php" >
                        <div class="card card-1">
                            <div id="layer">
                                <div class="card-body">
                                    <h3>Employés</h3>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

            <?php
                }
            }
            ?>
                <div class="col-md-3 col-sm-6">
                    <a href="ClientList.php" ><div class="card card-2">
                      <div id="layer">
                          <div class="card-body">
                              <h3>Clients</h3>
                          </div>
                      </div>
                    </div></a>
                </div>

                <div class="col-md-3 col-sm-6">
                    <a href="StockList.php"><div class="card card-4">
                      <div id="layer">
                          <div class="card-body">
                              <h3>Stocks</h3>
                          </div>
                      </div>
                    </div></a>
              </div>

                <div class="col-md-3 col-sm-6">
                    <a href="ProductList.php" type="button" ><div class="card card-3">
                      <div id="layer">
                          <div class="card-body">
                              <h3>Produits</h3>
                          </div>
                      </div>
                    </div></a>
              </div>
        </div>            
        </div>


        </div>
    </div>

    </body>
</html