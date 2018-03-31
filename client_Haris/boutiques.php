<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style_boutiques.css">   
      <link rel="stylesheet" href="css/style_button.css">    
	  

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
</head>


<!-- Jumbotron Header -->
<header class="">
	<?php include 'header.php';?>        
</header>







<body>

  <div id="vue-map">
  <div class="input-group mb-3">
  <input id="autocompleteInput" type="text" class="form-control" placeholder="Entrez votre adresse" style="margin-top:15px; text-align:center;">
  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="button">Chercher</button>
  </div>
</div>
  
 <div class="row">
 <div class="col-8"> <div id="map_canvas2"></div></div>
  <div class="col-4">
  <h2 v-if="noVisibleMarkers">Il n'y a pas de boutiques proches de votre adresse à moins de 400km :</h2>
  <ul class="" id="results-list" v-if="currentZoom > zoomTreshold">
    
	<li v-for="(marker, i) in visibleMarkers" >
      <strong>{{ marker.name }}</strong><br/>
	  <strong>Adresse :</strong><br/>
	  <span>{{ marker.boutique }}</span><br/>
      <span>Livraison en magasin : Oui</span><br/>
      <span v-if="currentLocation">Distance depuis votre adresse : {{ Math.round(marker.distanceFromCenter / 1000) + ' km' }}<br/></span>
      
      <button class="hoverMe" v-bind:data-id='marker.id' @click='centerMapToMarker'>Voir sur la carte</button>
	
    </li>
	
  </ul>
  </div>
  </div>
  <h2 v-else>Il y a {{ visibleMarkers.length }} boutiques, Si vous souhaitez afficher des magasins spécifiques, veuillez zoomer ou tapez sur la carte.</h2>
</div>



<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDlfHdTSE_d9zwwYKs5gbL01mHElMLCFgE&libraries=places,geometry"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js'></script>

  

    <script  src="js/boutiques.js"></script>




</body>





<footer>
    <?php include'footer.php';?>
</footer>
</html>

