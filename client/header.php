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


    
      
<link rel="stylesheet" href="css/style_Card.css">
<link rel="stylesheet" href="css/style_DropDown.css">
<link rel="stylesheet" href="css/style_lang.css">
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

  
  <!--
  
  -->
  
  
  
  
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<style>
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
</style>
  
  </head>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  <body>

  <header id="header">
<div class="container">

  <img src="images/logo.png" style="width:45px; length :30px;float:left;" alt="Accueil"><h1 class="logo">La vieille<span>Sardine</span></h1><h1 class="logoBas">- Villeneuve la vieille -</h1>
  
  <nav class="site-nav">
      <ul>
        <li><a href=""><i class=" "></i>
    
    <div id="lang-menu">
    <div>FR</div>
    <ul>
      <li>FR</li>
<li>EN</li>
<li>All</li>
    </ul>
</div>
    
    
    </a></li> 
        <li><a href="inscription_connexion/index.php"><i class=" fa fa-user site-nav--icon"></i>
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

        </a></li>
        <li><a href="shopping_cart_details.php"><i class="fa fa-shopping-cart site-nav--icon"></i>Panier</a></li>
       
      </ul> 
  </nav>
  
  <div class="menu-toggle">
    <div class="hamburger"></div>
  </div>
  
</div>

</header>




  
    <!-- Navigation -->
  <!--
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      
    <div class="container">
        <a class="navbar-brand" href="#" style="height: 100%;
    width: 8%;"><img src="images/logo.png" alt="Accueil"></a>
  <div class="textLogo" style="float:left;color: #4890ce;">
  <h3>La vieille sardine</h3>
  </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse right" id="navbarResponsive" >
          <ul class="navbar-nav ml-auto" style="float:right;">
           
            <li class="nav-item">
              <a class="nav-link" href="#"><div id="lang-menu">
    <div><img src="images/lang-fr.png"/></div>
    <ul>
      <li>FR</li>
<li>EN</li>
<li>All</li>
    </ul>
</div></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Connexion/Inscription</a>
            </li>
       <li class="nav-item">
       </li>
            <li class="nav-item">
              <a class="nav-link" href="#" style="text-align:center;"><p>Mon Panier</p><p>0.00&euro; </p></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  
  <!-- Les liste li pour les dropdown element -->
  <!-- Example single danger button -->
  <div class="btn-group-justified">
<div class="btn-group">
  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Conserves
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">à Rajouter</a>
    <a class="dropdown-item" href="#">à Rajouter</a>
    <a class="dropdown-item" href="#">à Rajouter</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">à Rajouter</a>
  </div>
</div>
<!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Plat préparés
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">à Rajouter</a>
    <a class="dropdown-item" href="#">à Rajouter</a>
    <a class="dropdown-item" href="#">à Rajouter</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">à Rajouter</a>
  </div>
</div>
<!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Les coffrets
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">à Rajouter</a>
    <a class="dropdown-item" href="#">à Rajouter</a>
    <a class="dropdown-item" href="#">à Rajouter</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">à Rajouter</a>
  </div>
</div>
<!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Nouveautés
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#">à Rajouter</a>
    <a class="dropdown-item" href="#">à Rajouter</a>
    <a class="dropdown-item" href="#">à Rajouter</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#">à Rajouter</a>
  </div>
</div>
  
  
  </div>
  
  
  <!-- Fin des dropdown -->



  