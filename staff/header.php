<nav class="navbar navbar-inverse" style="margin-top:20px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="Home.php" style="padding:5px;"><img src="logo.png" width="40px" style="display:inline;margin-right:10px">La Vieille Sardine : Intranet</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="MyAccount.php"><span class="glyphicon glyphicon-user"></span> Mon compte</a></li>
      <li><a href="logout.php">Deconnexion</a></li>
    </ul>
  </div>
</nav>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
session_start();
if(!isset($_SESSION['status'])||($_SESSION['status'] != 'A' && $_SESSION['status'] != 'E')) {
       echo "<script>alert('Vous n\'avez pas la permission d\'accéder cette page'); window.location='index.php'</script>";
}
?>