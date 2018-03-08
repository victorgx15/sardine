<?php

/*on inclue fichier de connexion à la bd */
require_once 'dbconnect.php';




if (isset($_POST['purchase'])) {
    //$email = $_POST['email'];
    if (!isset($_SESSION['user'])) {
    //header("Location: login.php");
    //exit;
    	echo "hey1";
	}
	echo "hey";
}


?>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>



<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<div class="container"></div>

    <div class="card">

            <div class="card-header bg-dark text-light">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Votre panier d'achat
                <a href="index.php" class="btn btn-outline-info btn-sm pull-right">Continuez vos achats</a>
                <div class="clearfix"></div>
            </div>
            <div class="card-body">

            	<?php 
            		//récupérer la session 
					session_start();
					//initialiser un tableau
					$eltsPanier=array();

					//if 1
					if(isset($_SESSION['cart'])){

						if(!empty($_GET["action"])) {
							switch($_GET["action"]) {
								case "remove":
									if(!empty($_SESSION["cart"])) {
										foreach($_SESSION["cart"] as $k => $v) {
												if($_GET["code"] == $k)
													unset($_SESSION["cart"][$k]);				
												if(empty($_SESSION["cart"])){
													unset($_SESSION["cart"]);
												}
										}
									}

								break;
								case "empty":
									unset($_SESSION["cart"]);

								break;	
							}
						}

						//if 2 : si la session a commencé mais qu'il y a pas de produit dedans
						if(empty($_SESSION['cart'])){
							echo "Votre panier est vide";
						}else{

							foreach($_SESSION['cart'] as $key => $item) {
						  		//DEBBUGING ONLY
						  		//echo "Quantity ".$item.' is associated with productID ('.$key.')';
						  		//$eltsPanier+=$key+',';
								array_push($eltsPanier, $key);
							}	

							//var_dump($_SESSION['cart']);
							$eltsPanier=implode(',', $eltsPanier);
							$stmt = $conn->prepare("SELECT * FROM produit where Id_Produit IN ($eltsPanier)");
							/*on execute la requete SQL enregistrée dans la variable stmt */
							$stmt->execute();
							$res = $stmt->get_result();
							$stmt->close();

							$prixtotal=0;

					while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){


						 
            	?>

	                <div class="row">
	                    <div class="col-xs-2 col-md-2">
	                        <img class="img-responsive" src=<?php echo $row["Url_Image"];?> alt="prewiew" height="80" width="120" align="middle">
	                    </div>
	                    <div class="col-xs-4 col-md-6">
	                        <h4 class="product-name"><strong>Référence : <?php echo $row["Ref"]; ?></strong></h4><h4><small><?php echo $row["Designation"]; ?></small></h4>
	                    </div>
	                    <div class="col-xs-6 col-md-4 row">
	                        <div class="col-xs-6 col-md-6 text-right" style="padding-top: 5px">
	                            <h6><strong><?php echo "Prix : ".$row["Prix"]."€"; $prixtotal+=$row["Prix"]*$_SESSION['cart'][$row["Id_Produit"]];?> <span class="text-muted">x</span></strong></h6>
	                        </div>
	                        <div class="col-xs-4 col-md-4">
	                            <input  type="button" class="form-control input-sm" value=<?php echo $_SESSION['cart'][$row["Id_Produit"]]; ?>>
	                        </div>
	                        <div class="col-xs-2 col-md-2">
							    <form action ="/" method = "get">
							    	<td style="text-align:center;border-bottom:#F0F0F0 1px solid;">
							    		<a href="shopping_cart_details.php?action=remove&code=<?php echo $row["Id_Produit"]; ?>" class="btn btn-outline-danger btn-xs">X</a></td>
		                                <i class="fa fa-trash" aria-hidden="true"></i>
		                            </button>
	                        	</form>
                        </div>
	                    </div>
	                </div>
	            <?php 
						//fin while
						}

					
            	?>
                <hr>
               

                <hr>
                <div class="pull-right">
                	<table class=buttons style="width: 100%;table-layout: fixed;border-collapse: collapse;margin-bottom: 5px;">
						 <tr>
						    <td><a href="shopping_cart_details.php?action=empty" class="btn btn-outline-secondary pull-right" style="width: 25%;">Vider le panier</a>
						</table>
                </div>
            </div>
            <div class="card-footer">
            	<form action="" method="post">
            		<button type="submit" name="purchase" class="btn btn-success pull-right">Passer la commande</button>
                	<!--<a type="submit" name="purchase" href="inscription_connexion/login.php" class="btn btn-success pull-right">Passer la commande</a>-->
            	</form>
                <div class="pull-right" style="margin: 5px">
                    Prix ​​total: <b>
	                    <?php
	                    //reduction selon page 10 cahier de charge
	                    if($prixtotal<229){
							echo $prixtotal;
	                    }else{
		                    $prixremise=0;
		                    $remise=0;
		                    if($prixtotal>229 && $prixtotal<=381){
								$prixremise=$prixtotal*(1-0.03);
								$remise=3;
		                    }elseif ($prixtotal>381 && $prixtotal<=1220){
								$prixremise=$prixtotal*(1-0.05);
								$remise=5;
		                    }elseif( $prixtotal>1220){
		                    	$prixremise=$prixtotal*(1-0.07);
		                    	$remise=7;
		                    }

		                     echo $prixtotal."€ avec remise de ".$remise."% est : ".$prixremise;	
	                    }
	                    
	                     ?>
                  
                  	€</b>
                </div>
            </div>
        </div>

        <?php
        //fin else 2
					}
        //panier est vide
					}else{

						echo "<p><strong>Votre panier est vide !</strong></p>";
					}
		?>
</div>

