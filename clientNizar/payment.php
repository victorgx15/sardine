<!DOCTYPE html>
<html>
<head>
	<title>Paiment</title>
</head>
<body>

<header>
	<?php include'header.php';?>
</header>


    <div class="jumbotron" align="center">
        <h2>Veuillez choisir votre mode de paiement</h2>

    </div> 

    <div class="jumbotron" align="center">
         		<div class="form-group" style="width: 50%;" align="center">
	                <div class="col-sm-3">
						<label class="radio-inline">
				      		<input type="radio" name="livraison" checked="checked" style="vertical-align: middle"><a4><strong>Par chèque.</strong></a4>
				    	</label>
	                </div>
	                <div class="col-sm-3">
				    	<label class="radio-inline">
				      		<input type="radio" name="livraison" checked="checked" style="vertical-align: middle"><a4><strong>Via Paypal.</strong></a4>
				    	</label>
	                </div>
	            </div>
    </div> 



            	


	<div class="modal-footer">
        	<form method="post"  action="">
	            <input type="submit" name="continu" type="button" class="btn btn-success" value="Continuez vers l'étape suivante" >
        	</form>
        </div>

<footer>
	<?php include'footer.php';?>
</footer>
</body>


</html>