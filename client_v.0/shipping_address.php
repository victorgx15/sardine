<?php
// Sous WAMP (Windows)
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Adresse de livraison</title>

    <?php
    include('header.php');
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $id=$_SESSION['user'];

    ?>
</head>

<div class="jumbotron" align="center">
    <h2>Comment souhaiteriez vous être livré ?</h2><br>
</div>  

<div class="container">
                <h2>En boutique</h2>
                <h4>Choisissez la boutique la plus proche de vous</h4>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-send"></span></span>
                        <div align="right" style="display: table-cell;vertical-align:middle;width:100%;">
                            <select  id="Pays" name="Pays"  class="form-control" style="height: 40px;">
                    	    <?php
					            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Status='B' "); //pour les boutiques le status sera 'B' et l'Id_client correspondra à l'ID_Boutique
					            $addressList->execute();
					            while($adr = $addressList->fetch()){
	            			?>
                    	    	<option value=""><?php echo $adr['Adresse']." ".$adr['Postal_Code']." ".$adr['Ville']." ".$adr['Pays'];?></option>
                    	    <?php
				            }
				            ?>
                            </select>
                        </div>
                    </div>
                </div>

                <h2>Chez vous</h2>
                <h4>Choisissez l'adresse de votre domicile</h4>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                        <div align="right" style="display: table-cell;vertical-align:middle;width:100%;">
                            <select  id="Pays" name="Pays"  class="form-control" style="height: 40px;">
                    	    <?php
					            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Id_Client='$id' "); //pour les boutiques le status sera 'B' et l'Id_client correspondra à l'ID_Boutique
					            $addressList->execute();
					            while($adr = $addressList->fetch()){
	            			?>
                    	    	<option value=""><?php echo $adr['Adresse']." ".$adr['Postal_Code']." ".$adr['Ville']." ".$adr['Pays'];?></option>
                    	    <?php
				            }
				            ?>
                            </select>
                        </div>
                    </div>
                </div>

    <div class="modal-footer">
      	<form method="post"  action="payment.php">
	        <input type="submit" name="continu" type="button" class="btn btn-success" value="Continuez vers l'étape suivante" >
       	</form>
    </div>
</div>

<!-- inclure le footer-->
<?php include 'footer.php';?>

<script type="text/javascript">
    $(document).ready(function(){ 
    $("input[name$='livraison']").click(function() {
        var test = $(this).val();
        $(".desc").hide();
        $("#"+test).show();
    }); 
	});
</script>


</html>