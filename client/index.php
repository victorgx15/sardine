<!DOCTYPE html>
<html lang="en">


 <?php 
 	include 'header.php';
 ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="  my-4">
	  <!-- Slider qui défile -->
	   <?php include 'slider.php';?>        
      </header>

      <!-- Page Features -->
      <div class="row text-center">
	        <!--D E C O U V R I R -->
	        <div class="col-md-4 col-sm-6">
	          	<div class="card card-3">
				  <div id="layer">
				    <button id="comprar">Découvrir</button>
				  </div>
	 			</div>
	        </div>

	        <!--D E C O U V R I R -->
	        <div class="col-md-4 col-sm-6">
	          <div class="cardNeauveau">
	            <div class="card card-1">
				  <div id="layer">
				    <button id="comprar">Voir la promotion</button>
				  </div>
				</div>
	          </div>
	        </div>

	      	<!--D E C O U V R I R -->
  			<div class="col-md-4 col-sm-6">
				<div class="card card-2">
				  <div id="layer">
				    <button id="comprar">En savoir plus</button>
				  </div>
				</div>            
	      </div>
	      <!-- /.row -->
    </div>
    <!-- /.container -->
	
    	

			

    	
	   
	<!-- CONTENEUR SECTION 
	on se connecte à la base de données pour prendre tous les produits, 
		pour ensuite les mettre dans une mysqli_fetch_array et les afficher dans une boucle-->
	   <section class="p-0" id="portfolio">
	      <div class="container-fluid p-0">
	        <div class="row no-gutters popup-gallery">

		<?php
	    /*on inclue fichier de connexion à la bd */
    	require_once 'dbconnect.php';
		$stmt = $conn->prepare("SELECT * FROM produit");
	   	/*on execute la requete SQL enregistrée dans la variable stmt */
	    $stmt->execute();
	    $res = $stmt->get_result();
	    $stmt->close();

	   	/*on retire tous les enregistrements dans la table produit */
	    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
    	?>

	          <div class="col-lg-4 col-sm-6">
	            <!--On utilise URL image pour affiche l'image du produit -->
	            <a class="portfolio-box" href="product_details.php?id=<?php echo $row["Id_Produit"]; ?>">
	              <img class="img-fluid" src=<?php echo $row["Url_Image"]; ?> alt="">
	              <div class="portfolio-box-caption">
	                <div class="portfolio-box-caption-content">
	                     <!--On affiche la référence du produit -->
	                  <div class="project-category text-faded">
	                    <?php echo $row["Ref"]; ?>
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
	            </a>
	          </div>

		<?php 
		}
    	?>


	      </div>
    </section>
	
	<!-- inclure N O S   S E R V I C E S -->	
	<?php include 'nos_services.php';?>
	</div>

 
	<!-- inclure le footer-->
	<?php include 'footer.php';?>

    

	
	<!-- js du carroussel-->
	<script  src="js/caroussel.js"></script>
	
	<!-- Fin js du carroussel-->
	<script  src="js/lang.js"></script>
  </body>

</html>
