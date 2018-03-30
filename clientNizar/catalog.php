<!DOCTYPE html>
<html lang="en">


 <?php 
 	include 'header.php';
 		    /*on inclue fichier de connexion à la bd */
    	require_once 'dbconnect.php';
		//$stmt = $conn->prepare("SELECT * FROM produit");
	   	$categorie=$_GET["categorie"];
	   	$souscategorie="";
	   	$stmt = $conn->prepare("SELECT * FROM produit WHERE Ref LIKE '%$categorie%'");

	   	if(isset($_GET["souscategorie"])){
		   	$souscategorie=$_GET["souscategorie"];
		   	$stmt = $conn->prepare("SELECT * FROM produit WHERE Ref='$souscategorie'");
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
        <h2><?php echo $categorie;?></h2><br>
        <h4><?php echo $souscategorie = str_replace('_', ' ', $souscategorie);?></h4><br>

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
	

      <div class="jumbotron" align="center" style="padding-top: 10px;padding-bottom: 10px;">
        <h2>Nos services</h2><br>
      </div> 
	<!-- inclure le footer-->
	<?php include 'footer.php';?>

    

	
	<!-- js du carroussel-->
	<script  src="js/caroussel.js"></script>
	
	<!-- Fin js du carroussel-->
	<script  src="js/lang.js"></script>
  </body>

</html>
