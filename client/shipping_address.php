<?php
// Sous WAMP (Windows)
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
    include('header.php');
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $id=$_SESSION['user'];
    ?>

    <style>
        input[readonly] {
            cursor: pointer;
        }
        input[disabled] {
            cursor: pointer;
        }
    </style>
</head>

<div class="jumbotron" align="center">
    <h2>Comment souhaiteriez vous être livré ?</h2><br>
    <form class="form-horizontal" method="post" id="edit_account" action="EditAccount.php">
        <?php
        $accountInfo = $bdd->prepare("SELECT Email, Nom, PRENOM, Tel, Civilite, Password, Status FROM compte WHERE Id_Client = ".$_SESSION['user']."");
        $accountInfo->execute();
        while ($compte = $accountInfo->fetch()) {
        ?>
        <div class="container">
            <div class="form-group">
                <input type="hidden" value="<?php  echo $id;?>" id= "id" name="id" >
                <input type="hidden" value="<?php  echo $compte['Status'];?>" id="Status" name="Status" >
                <input type="hidden" value="<?php  echo $compte['Password'];?>" id="Password" name="Password" >


				<label class="control-label col-sm-2" for Civilite> Mode de livraison : </label>
                <div class="col-sm-2">
                   <form>
				    <label class="radio-inline">
				      <input type="radio" name="livraison" checked="checked" style="vertical-align: middle">En boutique.
				    </label>
				    <label class="radio-inline">
				      <input type="radio" name="livraison" style="vertical-align: middle">A domicile.
				    </label>
				  </form>
                </div>
            </div>

            <div id="livraison_boutique" class="desc">
            	<div class="form-group">
	                <label class="control-label col-sm-2" for Adresse> Nos boutiques : </label>
	                <div class="col-sm-3">
	                    <select name="adresse_boutique" id="adresse_boutique" class="form-control">
                    	    <?php
					            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Status='B' "); //pour les boutiques le status sera 'B' et l'Id_client correspondra à l'ID_Boutique
					            $addressList->execute();
					            while($adr = $addressList->fetch()){
	            			?>
                    	    	<option value=""><?php echo $adr['Adresse'];?></option>
                    	    <?php
				            }
				            ?>
                    	</select>
	                </div>
	            </div>
            </div>

            <div id="livraison_domicile" class="desc">
	            <br>

            	<div class="form-group">
	                <label class="control-label col-sm-2" for Adresse> Vos adresses : </label>
	                <div class="col-sm-3">
	                    <select name="adresse_boutique" id="adresse_boutique" class="form-control">
                    	    <?php
					            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Id_Client='$id' ");
					            $addressList->execute();
					            while($adr = $addressList->fetch()){
	            			?>
                    	    	<option value=""><?php echo $adr['Adresse'];?></option>
                    	    <?php
				            }
				            ?>
				            	<option value="">Ajouter une autre adresse</option>
                    	</select>
	                </div>
	            </div>


	            <?php
	            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Id_Client='$id' ");
	            $addressList->execute();
	            while($adr = $addressList->fetch()){
	                ?>
	                <div class="form-group">
	                    <label class="control-label col-sm-2" for Adresse> Adresse : </label>
	                    <div class="col-sm-3">
	                        <input type="text" class="form-control" name="Adresse" id="Adresse"  value="<?php echo $adr['Adresse'];?>">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-2" for Ville> Ville : </label>
	                    <div class="col-sm-3">
	                        <input type="text" class="form-control"  name="Ville" id="Ville"  value=<?php echo $adr['Ville'];?>>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-2" for Postal_Code> Code Postal : </label>
	                    <div class="col-sm-2">
	                        <input type="text" class="form-control" name="Postal_Code" id="Postal_Code" value=<?php echo $adr['Postal_Code'];?>>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="control-label col-sm-2" for Pays> Pays : </label>
	                    <div class="col-sm-2">
	                        <input type="text" class="form-control" name="Pays" id="Pays" required value=<?php echo $adr['Pays'];?>>

	                    </div>
	                </div>
	                <?php
	            }
	            ?>
	            
	            <?php
	            if(!$_GET['Edit']){
	                ?>
	                <a href="MyAccount.php?Edit=1" class="btn btn-info">Modifier les informations</a> <br><br>
	                <?php
	            }
	            ?>
            </div>

        </div>

        <div class="modal-footer">
            <input type="submit" type="button" class="btn btn-success" value="Confirmer" >
        </div>
        <?php }
        ?>
    </form>

</div>

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