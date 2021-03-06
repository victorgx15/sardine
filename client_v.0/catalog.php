<!DOCTYPE html>
<html lang="en">


 <?php 
 	include 'header.php';
 		    /*on inclue fichier de connexion à la bd */
    	require_once 'dbconnect.php';
		//$stmt = $conn->prepare("SELECT * FROM produit");
	   	$famille=$_GET["famille"];
	   	$gamme="";
	   	$stmt = $conn->prepare("SELECT * FROM produit WHERE Famille LIKE '$famille'");

	   	if(isset($_GET["gamme"])){
		   	$gamme=$_GET["gamme"];
		   	$stmt = $conn->prepare("SELECT * FROM produit WHERE Gamme='$gamme' AND Famille LIKE '$famille'");
	   	}
	   	


	   	/*on execute la requete SQL enregistrée dans la variable stmt */
	    $stmt->execute();
	    $res = $stmt->get_result();
	    $stmt->close();

 ?>

    <!-- Page Content -->
    <div class="container">
      <!-- Jumbotron Header -->
      <header class="  my-4">
      <div class="jumbotron" align="center"  style="padding-top: 10px;padding-bottom: 10px;">
        <h2><?php echo $famille;?></h2><br>
        <h4><?php echo $gamme = str_replace('_', ' ', $gamme);?></h4><br>

      </div>
      </header>

    <!-- /.container -->
	
	<!-- CONTENEUR SECTION 
	on se connecte à la base de données pour prendre tous les produits, 
		pour ensuite les mettre dans une mysqli_fetch_array et les afficher dans une boucle-->
	   <section class="p-0" id="portfolio">
	      <div class="container-fluid p-0">
	        <div class="row no-gutters popup-gallery">

		<?php


	   	/*on retire tous les enregistrements dans la table produit */
	    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
    	?>

	          <div class="col-lg-4 col-sm-6" >
	            <!--On utilise URL image pour affiche l'image du produit -->
	            <a class="portfolio-box" href="product_details.php?id=<?php echo $row["Id_Produit"]; ?>">
	              <img class="" src=<?php echo $row["Url_Image"]; ?> alt="">
	              <div class="portfolio-box-caption">
	                <div class="portfolio-box-caption-content">
	                     <!--On affiche la référence du produit -->
	                  <div class="project-category text-faded">
	                    <?php echo str_replace('_', ' ', $row["Ref"]); ?>
	                  </div>
	                     <!--On affiche la designation du produit -->
	                  <div class="project-name">
	                     <?php echo $row["Designation"]; ?>
	                  </div>
	                  <div class="project-name">
	                     <?php echo "<a4><p><strong>".$row["Prix"]."€<a4></p></strong>"; ?>
	                  </div>
	                </div>
	              </div>
	            <div class="" align="center" style="display:table;width: 100%">
			        <div align="left" style="display: table-cell;vertical-align:middle;padding:5%;width:50%; color: #303030;"><strong><?php echo $row["Designation"]; ?></strong></div> 
			       	<div align="right" style="display: table-cell;vertical-align:middle;padding:5%;width:50%; color: #303030;"><?php echo "<strong>".$row["Prix"]."€</strong>"; ?></div>
			    </div>   

	          </div>
	          
	            </a>


		<?php 
		}
    	?>


	      </div>
    </section>
	


	<!-- inclure le footer-->
	<?php include 'footer.php';?>

    

	
	<!-- js du carroussel-->
	<script  src="js/caroussel.js"></script>
	
	<!-- Fin js du carroussel-->
	<script  src="js/lang.js"></script>
  </body>

</html>
