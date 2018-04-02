<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.5/js/dataTables.select.min.js"></script>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.5/css/select.bootstrap.min.css">

<style>
    .btn-purple {
        color: #ffffff;
        background-color: #611BBD;
        border-color: #130269;
    }

    .jumbotron {
        background: rgba(255, 255, 255, 0.61);
    }
    body{
        background-image: url("background.jpg");

    }
    table{
        background: white;
    }

    .btn-circle {
        width: 22px;
        height: 22px;
        padding:0;
        border-radius: 50%;
        margin:auto;
    }

</style>

<?php
session_start();
if(!isset($_SESSION['status'])||($_SESSION['status'] != 'A' && $_SESSION['status'] != 'E')) {
       echo "<script>alert('Vous n\'avez pas la permission d\'accéder cette page'); window.location='index.php'</script>";
}


?>
<nav class="navbar navbar-inverse" style="margin-top:20px; background-color:#0c154c">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="Home.php" style="padding:5px;"><img src="logo.png" style="display:inline;margin-right:10px;width:40px;">La Vieille Sardine : Intranet</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="MyAccount.php?Edit=0"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['PRENOM'].' '.$_SESSION['Nom'];?></a></li>
            <li><a href="logout.php">Deconnexion</a></li>
        </ul>
    </div>
</nav>
