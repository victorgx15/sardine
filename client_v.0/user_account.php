<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Espace Perso</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
</head>

<header>
    <?php include'header.php';
    $userId=$_SESSION['user']?>
</header>


<body>


      <!-- Page Content -->
    <div class="container"  style="margin-top: 10px;margin-bottom: 10px;" align="center">


    <div class="jumbotron" align="center">
        <h2>Bienvenu dans votre Espace Personnel</h2><br>
    </div>    

    <section class="p-0" id="portfolio" align="center" >
        <div class="container-fluid p-0" style="width: 80%;">
            <div class="row no-gutters popup-gallery">
              

              <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" data-toggle="modal" data-target="#editAddressModal">
                  <img class="img-fluid" src="images/user_account.png" alt="" >
                  <div class="portfolio-box-caption">
                    <div class="portfolio-box-caption-content">
                       <div class="project-name">
                         <a4><p><strong>Modifiez vos adresses de livraison</p></a4></strong>
                      </div>
                      <div class="project-category text-faded">
                         <h5><p><strong>Saisissez de nouvelles adresses pour vous faire livrer</strong></p></h5>
                      </div>
                      <div class="project-name">
                         <a4><p><strong></p></a4></strong>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

<?php
include('editAddressModal.php');
?>

             <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="DisplayPurchasesInfos.php?ID_Client=<?php echo $userId;?>">
                  <img class="img-fluid" src="images/user_account2.png" alt="">
                  <div class="portfolio-box-caption">
                    <div class="portfolio-box-caption-content">
                      <div class="project-name">
                         <a4><p><strong>Suivez l'état de vos commandes</p></a4></strong>
                      </div>
                     <div class="project-category text-faded">
                         <h5><p><strong>Consultez votre historique d'achat et demandez des retours</strong></p></h5>
                      </div>
                      <div class="project-name">
                         <a4><p><strong></p></a4></strong>
                      </div>
                    </div>
                  </div>
                </a>
              </div>


             <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" data-toggle="modal" data-target="#editAccountModal">
                  <img class="img-fluid" src="images/user_account3.png" alt="">
                  <div class="portfolio-box-caption">
                    <div class="portfolio-box-caption-content">
                      <div class="project-name">
                         <a4><p><strong>Modifier vos infos personnels</p></a5></strong>
                      </div>
                      <div class="project-category text-faded">
                         <h5><p><strong>Votre liberté passe avant tout</strong></p></h5>
                      </div>
                      <div class="project-name">
                         <a4><p><strong></p></a4></strong>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

<?php
include('editAccountModal.php');
?>


            </div>
          </div>
    </section>



<div class="jumbotron" align="center"  style="margin-top: 30px;margin-bottom: 10px;">
        <h2>Nos best seller</h2><br>
</div>    


<section class="p-0" id="portfolio" >
        <div class="container-fluid p-0">
          <div class="row no-gutters popup-gallery">

    <?php
      /*on inclue fichier de connexion à la bd */
      require_once 'dbconnect.php';
    //$stmt = $conn->prepare("SELECT * FROM produit");
      
      $stmt = $conn->prepare("SELECT *, SUM(Quantite) FROM `lignecommande` l JOIN `produit` p ON l.Id_Produit=p.Id_Produit JOIN `commande` c ON l.Id_Commande=l.Id_Commande GROUP BY l.Id_Produit ORDER BY SUM(Quantite) DESC LIMIT 3");
      


      /*on execute la requete SQL enregistrée dans la variable stmt */
      $stmt->execute();
      $res = $stmt->get_result();
      $stmt->close();

      /*on retire tous les enregistrements dans la table produit */
      while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
      ?>

            <div class="col-lg-4 col-sm-6" >
              <!--On utilise URL image pour affiche l'image du produit -->
              <a class="portfolio-box" href="product_details.php?id=<?php echo $row["Id_Produit"]; ?> ">
                <img class="" src=<?php echo $row["Url_Image"]; ?> alt="" >
                <div class="portfolio-box-caption">
                  <div class="portfolio-box-caption-content">
                       <!--On affiche la référence du produit -->
                    <div class="project-category text-faded">
                      <?php echo str_replace('_', ' ', $row["Ref"]);?>
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


</div>


</body>

<footer>
  <div class="container">
    <?php include'footer.php';?>
  </div>
</footer>
</html>
