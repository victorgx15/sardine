<!DOCTYPE html>
<html>
<head>
	<title>Paiment</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	      <link rel="stylesheet" href="css/cheque.css">
		  	      <link rel="stylesheet" href="css/switch.css">

		  

	<style>
	
	.afficher {
  display: block;
}

.PasAfficher {
  display: none;
}

#etape{
	display: none;
	
}
	
	</style>
	
</head>
<body>

<header>
	<?php include'header.php';?>
	
	
	



</header>

<?php

/*on inclue fichier de connexion à la bd */
//récupérer la session 
//session_start();
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



    <div class="jumbotron" align="center">
        <h2>Veuillez choisir votre mode de paiement</h2>

    </div> 

    <div class="jumbotron" align="center">
	<div class="switch">
  <input name="radio" type="radio" value="optionone" id="optionone" onclick="show2();" />
  <label for="optionone">Via Paypal</label>
  
  <input name="radio" type="radio" value="optiontwo" id="optiontwo"  onclick="show1();" checked />
  <label for="optiontwo" class="right">Par chèque</label>
  
  <span aria-hidden="true"></span>
</div>
	
	
	
	
	
	
	
	
	
         		
				
				
				
    </div> 



      <div id="div1" class="jumbotron afficher" align="center">
	  <div id="paypal-button-container"></div>
	  <div style="display:none;">
<div style="display:none;">
	  <div style="display:none;">
	  
	  <?php include'shopping_cart_details.php';?>
	  
	  
	  </div>
	  </div>
	  </div>

				</div>   



 <div id="div2" class="jumbotron PasAfficher" align="center">

<div class="check">
  <div class="number">1025</div>
  <div class="date">05 Avril 2018</div>
  <div class="info">
    <div class="orderof">La Vieille Sardine</div>
    <div class="num"><?php
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
	                     ?></div>
    
  </div>
  <div class="memo"><?php echo $userRow['Nom']." ".$userRow['PRENOM'];?></div>
  <div class="sig"><?php echo $userRow['Nom']." ".$userRow['PRENOM'];?></div>
</div>

</div>

				


	<div id="etape" class="modal-footer">
        	<form method="post"  action="invoice.php">
	            <input type="submit" name="continu" type="button" class="btn btn-success" value="Continuez vers l'étape suivante" >
        	</form>
        </div>

		
		
<footer>
	<?php include'footer.php';?>
</footer>
<script>
		function show1(){
  document.getElementById('div1').style.display ='none';
  document.getElementById('div2').style.display ='block';
  document.getElementById('etape').style.display ='block';
}
function show2(){
  document.getElementById('div1').style.display = 'block';
  document.getElementById('div2').style.display ='none';
  document.getElementById('etape').style.display ='none';
}




$('.switch label').on('click', function(){
  var indicator = $(this).parent('.switch').find('span');
  if ( $(this).hasClass('right') ){
		$(indicator).addClass('right');
  } else {
    $(indicator).removeClass('right');
  }
});

		</script>
		
		
		<script src="https://www.paypalobjects.com/api/checkout.js"> </script>
		
		
		

		<script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production
			
			
			 style: {
            label: 'checkout',
            size:  'responsive',    // small | medium | large | responsive
            shape: 'pill',     // pill | rect
            color: 'gold'      // gold | blue | silver | black
        },

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                production: '<insert production client id>'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '<?php
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
	                     ?>', currency: 'EUR' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    window.alert('LaVieilleSardine : Paiement complété avec succes');
					window.location.href='invoice.php';
                });
            }

        }, '#paypal-button-container');

    </script>
</body>


</html>