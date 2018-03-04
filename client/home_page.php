<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/home_page.css">

<!------ Include the above in your HEAD tag ---------->
 



<div class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidebar-wrap">
                    <div class="sidebar-box">
	       <ul class="list-links">
              <a href="#"><li>Agriculture</li></a>
              <a href="#"><li>Astrology</li></a>
              <a href="#"><li>Animals & Pets</li></a>
              <a href="#"><li>ARCHITECTURE</li></a>
              <a href="#"><li>ART & PHOTOGRAPHY</li></a>
              <a href="#"><li>AUCTION TEMPLATES</li></a>
              <a href="#"><li>BEAUTY</li></a>
              <a href="#"><li>BOOKS</li></a>
              <a href="#"><li>BUSINESS</li></a>
              <a href="#"><li>CAFE AND RESTAURANT</li></a>
              <a href="#"><li>CARS</li></a>
              <a href="#"><li>CHARITY</li></a>
              <a href="#"><li>CHRISTMAS TEMPLATES</li></a>
              <a href="#"><li>COMMUNICATIONS</li></a>
              <a href="#"><li>COMPUTERS</li></a>
              <a href="#"><li>DATING</li></a>
              <a href="#"><li>EDUCATION</li></a>
              <a href="#"><li>ELECTRONICS</li></a>
              <a href="#"><li>ENTERTAINMENT</li></a>
              <a href="#"><li>EXTERIOR DESIGN</li></a>
			</ul>
	        
	        </div>
                </div>
                
            </div>
           

            <div class="col-md-9">
                <div class="content-wrap">
                    <div class="product-area">

	<div class="row text-center">
		
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

		<div class="col-md-4">
		    <div class="product-box">
		        <div class="product-img">
		            <img class="img-responsive" src=<?php echo $row["Url_Image"];?>>
		        </div>
		        <div class="product-name">
		            <a href=""><h5><?php echo $row["Designation"]; ?></h5></a>
		            <a href=""><h6><?php echo $row["Prix"]; ?></h6></a>
		        </div>
		        
		    </div>			
		 </div>

		  
		<?php 
				}
		    	?>
    </div>
		
		    
		

</div>
                    
                    
                    

                </div>
            </div>
        </div>
    </div>
</div>


  </body>
