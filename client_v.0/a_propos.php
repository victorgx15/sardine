<!DOCTYPE html>
<html>
<head>
	<title>A propos de nous</title>
</head>
<header>
	<?php include('header.php');?>
</header>


<body>

<div class="container" style="padding-bottom: 10%;">
	

<div id="myCarousel" class="carousel slide myCarousel" data-interval="false" data-ride="carousel" style="height: 500px;">
	<ol class="carousel-indicators">
	    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
	    <li data-target="#myCarousel" data-slide-to="1"></li>
	    <li data-target="#myCarousel" data-slide-to="2"></li>
	</ol> 
  <!-- Carousel items -->
    <div class="carousel-inner">
  	   <div class="active item">
     
      <img src="images/a_propos1.jpg" style="background-repeat: no-repeat; background-size: 100% 100%;height: 500px;"  alt="Regarder">
        <div class="container">
    <div class="carousel-caption">
          <h1></h1>
        </div>
        </div>
    </div>
    <div class="item">
	<img src="images/a_propos2.jpg" style="background-repeat: no-repeat; background-size: 100% 100%;height: 500px; " alt="Voir les promos">
        <div class="container">
        <div class="carousel-caption">
          <h1></h1>
        </div>
        </div>
    </div>
    
  <hr class="transition-timer-carousel-progress-bar" />
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	  <!-- Fin Slider qui défile -->


</div>


</div>

</body>

<footer>
	<?php include('footer.php');?>
</footer>
</html>