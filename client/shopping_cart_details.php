<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Votre ePanier</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
</head>
<header>

</header>

<?php

/*on inclue fichier de connexion à la bd */
//récupérer la session 
session_start();
require_once 'dbconnect.php';

if(isset($_POST['orderpaper'])){
	require('pdf_generator/fpdf.php');
	    header("Location: invoice.php");
}

if(isset($_POST['shippingaddress'])){
	    header("Location: shipping_address.php");
}

if (isset($_POST['purchase'])) {
    if (!isset($_SESSION['user'])) {
    header("Location: inscription_connexion/login.php");
    exit;
	}else{
		
		//a mettre apres validation du paiement 
		//unset($_SESSION["cart"]);
		
		$Date=date("Y-m-d");
	    $Date_Livraison=date("Y-m-d", strtotime($Date. ' + 3 days'));
	    $Etat='En cours de préparation';
	    $ID_Client=$_SESSION['user'];

		$stmt = $conn->prepare("INSERT INTO commande(Date, Date_Livraison, Etat, ID_Client) VALUES('$Date', '$Date_Livraison','$Etat','$ID_Client')");
		$stmt->execute();

		$stmt = $conn->prepare("SELECT MAX(`Id_Commande`) FROM `commande`");
		$stmt->execute();
		$res = $stmt->get_result();
		$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

		$ID_Commande=$row["MAX(`Id_Commande`)"];
		foreach($_SESSION["cart"] as $idProduit => $quantite) {
			$stmt = $conn->prepare("INSERT INTO lignecommande(Quantite, ID_Commande, ID_Produit) VALUES('$quantite','$ID_Commande','$idProduit')");
			$stmt->execute();
		}		
		echo "<p><strong>Votre commande est passée avec succès !</strong></p>";		
		
		$stmt->close();

	}
}


?>




<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<body>
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
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="KG2WQ7Z3AJRUU">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>

                <div class="pull-right" style="margin: 5px">
                    Prix ​​total: <b>
	                    <?php
		                    //reduction selon page 10 cahier de charge
		                    if (!isset($_SESSION['user'] )) {
		                    	reduction($prixtotal,"V");
							}else{
								$res = $conn->query("SELECT * FROM compte WHERE ID_Client=" . $_SESSION['user']);
	             				$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
	             				$statusClient=$userRow['Status'];
	             				if($statusClient=='C'){
		             				reduction($prixtotal,"C");
	             				}//else client Professionnel
	             				else{
	             					reduction($prixtotal,"P");
	             				}	
							}
	                     ?>
                  
                  	€</b>
                </div>
            </div>

            <div class="card-footer">
            	<form action="" method="post">
            		<button type="submit" name="orderpaper" class="btn btn-success pull-right">Bon de commande </button>
                	<!--<a type="submit" name="purchase" href="inscription_connexion/login.php" class="btn btn-success pull-right">Passer la commande</a>-->
                	<button type="submit" name="shippingaddress" class="btn btn-success pull-right">Adresse de livraison </button>
                	<!--<a type="submit" name="purchase" href="inscription_connexion/login.php" class="btn btn-success pull-right">Passer la commande</a>-->
            	</form>
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


<?php 

function reduction($prixtotal,$status) {
	if($status=="V" || $status=="C"){
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
	}else{
		if($prixtotal<1220){
		echo $prixtotal;
	}elseif($status=="P"){
		$prixremise=0;
		$remise=0;
		if($prixtotal>1220 && $prixtotal<=2020){
			$prixremise=$prixtotal*(1-0.07);
				$remise=7;
		}elseif ($prixtotal>2020 && $prixtotal<=3010){
			$prixremise=$prixtotal*(1-0.09);
			$remise=9;
		}elseif( $prixtotal>3010){
			$prixremise=$prixtotal*(1-0.11);
			$remise=11;
	    }

		echo $prixtotal."€ avec remise de ".$remise."% est : ".$prixremise;	
	}
	}
							
}
?>


</body>

<footer>
<!-- inclure le footer-->
</footer>

</html>

