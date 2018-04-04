<?php session_start();?>
<head>
  <!--Style carroussel-->
 <link rel="stylesheet" href="css/style_Caroussel.css">
  <!--Fin Style carroussel-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>La Vieille Sardine - Home</title>

	
  <link rel="stylesheet" href="css/style_drop.css">    

  <link rel="stylesheet" href="css/style_footer.css">    
<link rel="stylesheet" href="css/style_Card.css">
<link rel="stylesheet" href="css/style_DropDown.css">
<link rel="stylesheet" href="css/style_lang.css">
<link rel="stylesheet" href="css/style_poisson.css">

    <!-- Bootstrap core CSS -->
  
  <!--
  à supprimer
  -->
  <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
  <!--
  
  -->
  
  <script  src="js/background.js"></script>
  
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<style>


.logo{
  padding-top: 15px;
  padding-left: 10px;
  font-size: 15px;
}
.btn{
border-radius: 0px !important;
}
.dropdown-item{
width:275px;
}
.navbar{
margin-bottom:1px;
}
.btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover, .btn-primary:active.focus, .btn-primary:active:focus, .btn-primary:active:hover, .open>.dropdown-toggle.btn-primary.focus, .open>.dropdown-toggle.btn-primary:focus, .open>.dropdown-toggle.btn-primary:hover, .btn-primary:hover{
background-color: #99d5cb !important;
}
.btn-primary{
background-color: #0c7cbb !important;
}

a:focus, a:hover{
	
	    color: #6ac5f6 !important;
    text-decoration: none !important;
}













</style>
  
  </head>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script  src="js/background.js"></script>
  <body>

  <header class="navbar navbar-inverse" style="width:1120px;margin:auto;margin-top: 20px;">
<div class="container">
  <a href="index.php" style="color: #FFFFF0;">
    <img src="images/logo.png" style="width:45px; length :30px;float:left;" alt="Accueil">
      <h1 class="logo">La vieille Sardine</h1>
  </a>
  <nav class="site-nav" style="margin-top: 3px;">
      <ul>
        <li><a href=""><i class=" "></i>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" >
                      <i class=""></i>
                       <?php 
                          echo "Langue";
                      ?>
                      </a>
                    <ul class="dropdown-menu" style="width: 10px;">
                        <li><a href=""><img class="img-responsive" src="images/lang-fr.png">&nbsp;FR</a></li>
                        <li><a href=""><img class="img-responsive" src="images/lang-us.png">&nbsp;ENG</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class=" fa fa-user site-nav--icon"></i>
                       <?php 
                        if (isset($_SESSION['user'])) {
                          // select logged in users detail
                          require_once 'dbconnect.php';
                          $res = $conn->query("SELECT * FROM compte WHERE ID_Client=" . $_SESSION['user']);
                          $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
                            echo "Hello, ".$userRow['PRENOM'];
                        }else{
                          echo "Connexion | Inscription";
                        }
                      ?>
                      </a>
                    <ul class="dropdown-menu">
                       <?php 
                        if (isset($_SESSION['user'])) {
                          // select logged in users detail
                          require_once 'dbconnect.php';
                          $res = $conn->query("SELECT * FROM compte WHERE ID_Client=" . $_SESSION['user']);
                          $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
                       ?>
                        <li><a href="user_account.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Espace Perso</a></li>
                        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Déconnexion</a></li>
                        <?php 
                        }
                        else{
                        ?>
                        <li><a href="register.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Inscription | Connexion</a></li>
                        <?php 
                        }
                      ?>
                    </ul>
                </li>

        <li><a href="shopping_cart_details.php"><i class="fa fa-shopping-cart site-nav--icon"></i>Panier</a></li>
       
      </ul> 
  </nav>
  
  <div class="menu-toggle">
    <div class="hamburger"></div>
  </div>
  
</div>

</header>

<?php 
$urlpath="http://localhost/sia/sardine/clientNizar/";
?>

  <div class="btn-group-justified" style="width:auto;padding-bottom: 40px;">
<ul class="hList">
  <li>
    <a href="#click" class="menu">
      <h2 class="menu-title">Conserves</h2>
      <ul class="menu-dropdown">
        <li onclick="location.href='catalog.php?famille=Conserve&gamme=Thon';">Thon</li>
        <li onclick="location.href='catalog.php?famille=Conserve&gamme=Sardine';">Sardine</li>
        <li onclick="location.href='catalog.php?famille=Conserve&gamme=Maquereaux';">Maquereau</li>
        <li style="color: #3a3737;" onclick="location.href='catalog.php?famille=Conserve';">Tous les produits</li>
      </ul>
    </a>
  </li>
  <li>
    <a href="#click" class="menu">
      <h2 class="menu-title menu-title_2nd">Plats préparés</h2>
      <ul class="menu-dropdown">
        <li onclick="location.href='catalog.php?famille=Plat&gamme=Thon';">À base de thon</li>
        <li onclick="location.href='catalog.php?famille=Plat&gamme=Sardine';">À base de sardine</li>
        <li onclick="location.href='catalog.php?famille=Plat&gamme=Maquereau';">À base de maquereau</li>
<li style="color: #3a3737;" onclick="location.href='catalog.php?famille=Plat';">Tous les plats</li>
      </ul>
    </a>
  </li>
  <li>
    <a href="#click" class="menu">
      <h2 class="menu-title menu-title_3rd"> Les coffrets</h2>
      <ul class="menu-dropdown">
        <li onclick="location.href='catalog.php?famille=Coffret&gamme=Thon';">Thon</li>
        <li onclick="location.href='catalog.php?famille=Coffret&gamme=Sardine';">Sardine</li>
        <li onclick="location.href='catalog.php?famille=Coffret&gamme=Maquereau;">Maquereaux</li>
        <li onclick="location.href='catalog.php?famille=Coffret&gamme=Multiples';">Multiples</li>
        <li style="color: #3a3737;" onclick="location.href='catalog.php?famille=Coffret';">Tous les coffrets</li>
        
      </ul>
    </a>
  </li>
  <li>
    <a href="#" class="menu">
      <h2 class="menu-title menu-title_4th">Nouveautés</h2>
      <ul class="menu-dropdown">
        <li>Pas de nouveauté</li>
        
      </ul>
    </a>
  </li>
</ul>
  
  
  </div>
  <script  src="js/background.js"></script>
  <!-- Fin des dropdown -->



  