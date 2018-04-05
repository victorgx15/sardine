<?php
// Sous WAMP (Windows)
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Adresse de livraison</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/radio.css">

    <?php
    include('header.php');
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $id=$_SESSION['user'];

    if(isset($_POST['continu'])){
        $boutique=$_POST['boutique'];
        $domicile=$_POST['domicile'];

        var_dump($domicile);
        echo $domicile;
        echo $boutique;
        if($boutique=='---' and $domicile=='---'){
            echo "Veuillez choisir un mode de livraison s'il vous plaît";
        }elseif ($boutique!='---' and $domicile!='---') {
            echo "Veuillez choisir un seul mode de livraison s'il vous plaît";
        }elseif ($boutique!='---' or $domicile!='---') {
            echo "merci";
        }
    }
    ?>
</head>

<div class="jumbotron" align="center">
    <h2>Comment souhaiteriez vous être livré ?</h2><br>
</div>  

<div class="container">

        <form method="post"  action="">
		<div class="radio">
    <input id="radio-1" name="radio" type="radio" onclick="show1();"  checked>
    <label for="radio-1" class="radio-label">En boutique</label>
  </div>
  
             <div id="div1" >
                <h4>Choisissez la boutique la plus proche de vous</h4>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-send"></span></span>
                        <div align="right" style="display: table-cell;vertical-align:middle;width:100%;">
                            <select  id="boutique" name="boutique"  class="form-control" style="height: 40px;">
                                <option value="">---</option>
                    	    <?php
					            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Status='B' "); //pour les boutiques le status sera 'B' et l'Id_client correspondra à l'ID_Boutique
					            $addressList->execute();
					            while($adr = $addressList->fetch()){
	            			?>
                    	    	<option value=""><?php echo $adr['Adresse']." ".$adr['Postal_Code']." ".$adr['Ville']." ".$adr['Pays']; $id_adress=$adr['Id_Adresse'];?></option>
                    	    <?php
				            }
				            ?>
                            </select>
                        </div>
                    </div>
                </div>
				</div>

  <div class="radio">
    <input id="radio-2" name="radio" type="radio" onclick="show2();" >
    <label  for="radio-2" class="radio-label">Chez vous</label>
  </div>
  <div id="div2">
                <h4>Choisissez l'adresse de votre domicile</h4>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                        <div align="right" style="display: table-cell;vertical-align:middle;width:100%;">
                            <select  id="domicile" name="domicile"  class="form-control" style="height: 40px;">
                                <option value="">---</option>
                            <?php
					            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Id_Client='$id' "); //pour les boutiques le status sera 'B' et l'Id_client correspondra à l'ID_Boutique
					            $addressList->execute();
					            while($adr = $addressList->fetch()){
	            			?>
                    	    	<option value=""><?php echo $adr['Adresse']." ".$adr['Postal_Code']." ".$adr['Ville']." ".$adr['Pays']; $id_adress=$adr['Id_Adresse'];?> </option>
                    	    <?php
				            }
				            ?>
                            </select>
                        </div>
                    </div>
                </div>
				</div>

	        <input type="submit" name="continu" type="button" class="btn btn-success" value="Continuez vers l'étape suivante" >
       	</form>
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
	
	
	
		function show1(){
  document.getElementById('div2').style.display ='none';
  document.getElementById('div1').style.display ='block';
}
function show2(){
  document.getElementById('div2').style.display = 'block';
  document.getElementById('div1').style.display ='none';
}
</script>


</html>