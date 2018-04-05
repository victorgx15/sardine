<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style_contactez_nous.css">    

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
</head>


<!-- Jumbotron Header -->
<header class="">
	<?php include 'header.php';?>        
</header>


<style>
input, textarea {
    color: #2c2c2e !important;
}

</style>




<body>

  <header class="Contact">
	<h1 style="font-weight: normal;
	font-size: 4em;
	font-family: 'Raleway', sans-serif;
	margin: 0 auto;
	margin-top: 40px;
	width: 500px;
	color: #0c154c;
	text-align: center;
">Contactez nous</h1>
</header>

<div class="container">
	

	
</div>
<div id="form">

<div class="fish" id="fish"></div>
<div class="fish" id="fish2"></div>

<form id="waterform" method="post">



<div class="formgroup" id="email-form">
    <label for="email">Votre e-mail*</label>
    <input type="email" id="email" name="email" />
</div>

<div class="formgroup" id="message-form">
    <label for="message">Votre message</label>
    <textarea id="message" name="message"></textarea>
</div>

	<input type="submit" value="Envoyer" />
</form>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/contactez_nous.js"></script>



</body>





<footer>
    <?php include'footer.php';?>
</footer>
</html>

