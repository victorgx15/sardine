
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eCommerce Product Detail</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

  </head>

<!-- NEEDED FOR PRODUCT DETAILS PAGE-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="css/product_details.css">

    <!--fin PRODUCT DETAILS-->


<header>
		   <?php include 'header.php';?>        

</header>


<?php
	    //session_start();
	    /*on inclue fichier de connexion à la bd */
    	require_once 'dbconnect.php';
	    /*on prend l'ID du produit envoyé depuis la page inde après click su produit par l'utilisateur */
		$id=$_GET["id"];
		$stmt = $conn->prepare("SELECT * FROM produit where Id_Produit=$id");
	   	/*on execute la requete SQL enregistrée dans la variable stmt */
	    $stmt->execute();
	    $res = $stmt->get_result();
	    $stmt->close();
	    
	    $stmtStock = $conn->prepare("SELECT SUM(Quantite_stock) FROM est_placer GROUP BY Id_Produit HAVING Id_Produit=$id");
	    $stmtStock->execute();
		
		$resultQuantityStock= mysqli_fetch_array($stmtStock->get_result(),MYSQLI_ASSOC); 
		if(isset($resultQuantityStock)){
		$quantityStock=$resultQuantityStock["SUM(Quantite_stock)"];
		}else{
		$quantityStock=0;
		}

?>



<?php


	    if(isset($_POST["add_to_cart"]))
	    {
	    	if(empty($_SESSION['cart'])){
	    		//initialisation de la session
	    		$_SESSION['cart']=array();
	    	}

	    	if($quantityStock-$_POST['quantity']>0){
//		    	$quantityStock=$quantityStock-$_POST['quantity'];
	    		if(isset($_SESSION['cart'][$id])){
	    			$_SESSION['cart'][$id]+=$_POST['quantity'];
	    		}
	    		else{
	    			$_SESSION['cart'][$id]=$_POST['quantity'];
	    		}
	    	}


	    	
	    }

		
	   	/*on retire tous les enregistrements dans la table produit */
	    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){

 ?>



  <body>
	
	<div class="container" >
		<div class="card" style="width: 100%; height: 100%;">
			<div class="container-fliud" >
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content" style="width: 60%;">
						  <div class="tab-pane active"  id="pic-1">
						  	<img href="" src=<?php echo $row["Url_Image"]; ?>  /></div>
						</div>
						
						
					</div>
					<div class="details col-md-6" style="width: 40%;">
						<h3 class="product-title"><?php echo $row["Designation"]; ?></h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 avis</span>
						</div>
						<p class="product-description"><?php echo $row["Description"]; ?></p>
						<h4 class="price">Prix : <span><?php echo $row["Prix"]; ?>€</span></h4>
						<h5 class="price">Etat du stock : 
							<span>
								<?php
								if($quantityStock==0){
									echo "Ce produit est indisponible pour le moment.";
								} elseif($quantityStock==1){
									echo $quantityStock." exemplaire disponible.";
								}else{
									echo $quantityStock." exemplaires disponibles.";
								}
								?>
							</span></h5>
						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
					

						<?php 
						//afficher bouton ajouter au panier quand il y a bien une quantité disponible 
						if($quantityStock>0){ ?>
						<div class="action">
							<form method="post">
								<button class="add-to-cart btn btn-default" type="submit" name="add_to_cart" value="add_to_cart">Ajouter au panier</button>
								<input type="input" class="like btn btn-default" type="button" name="quantity" value="1" style="width: 80px;"></input>
								<button class="like btn btn-default" type="button" name="signup"><span class="fa fa-heart" placeholder="Quantité souhaitée"></span></button>
							</form>
								<p class="">
									<?php  
								}
									if(isset($_POST["add_to_cart"]))
									{ 
										if($quantityStock-$_POST['quantity']>0){
											echo "<p><strong>Produit ajouté au panier.</strong></p>";
										}else{
											echo "<p><strong>Désolé, quantité indisponible au stock !</strong></p>";
										}
									//sleep(2);
									//echo "<script> window.location.assign('index.php'); </script>";

									} 
									?>
								</p>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>

  <?php
  		//fin while
    		}
?>


<!-- inclure le footer-->
<?php include 'footer.php';?>


</html>