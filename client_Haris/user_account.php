<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Espace Perso</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
</head>

<header>
    <?php include'header.php';?>
</header>


<body>


      <!-- Page Content -->
    <div class="container"  style="padding-top: 10px;padding-bottom: 10px;" align="center">


    <div class="jumbotron" align="center">
        <h2>Bienvenu dans votre Espace Personnel</h2><br>
    </div>    

    <section class="p-0" id="portfolio" align="center" >
        <div class="container-fluid p-0" style="width: 80%;">
            <div class="row no-gutters popup-gallery">
              

              <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="">
                  <img class="img-fluid" src="images/user_account.png" alt="" >
                  <div class="portfolio-box-caption">
                    <div class="portfolio-box-caption-content">
                       <div class="project-name">
                         <a4><p><strong>Modifier vos adresses</p></a4></strong>
                      </div>
                      <div class="project-category text-faded">
                         <a4><p><strong>Vous pouvez saisir une nouvelle adresse</p></a4></strong>
                      </div>
                      <div class="project-name">
                         <a4><p><strong></p></a4></strong>
                      </div>
                    </div>
                  </div>
                </a>
              </div>


             <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="" >
                  <img class="img-fluid" src="images/user_account2.png" alt="">
                  <div class="portfolio-box-caption">
                    <div class="portfolio-box-caption-content">
                      <div class="project-name">
                         <a4><p><strong>Suivez l'état de vos achats</p></a4></strong>
                      </div>
                     <div class="project-category text-faded">
                         <a4><p><strong>Consultez votre historique d'achat de nos produits<a4></p></strong>
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

                <!-- Edit Client Modal -->
                <?php
                try {
                    $id=$_SESSION['user'];
                    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $accountInfo = $bdd->prepare("SELECT * FROM compte WHERE Id_Client = '$id'");
                    $accountInfo->execute();
                    $compte=$accountInfo->fetch();
                ?>
                <div class="modal fade" id="editAccountModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                <h4>Modifier un client</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" id="edit_client" action="EditAccount.php">
                                    <div class="container">
                                        <div class="form-group">
                                            <input type="hidden" value="<?php  echo $id;?>" id= "id" name="id" >
                                            <input type="hidden" value="<?php  echo $compte['Status'];?>" id="Status" name="Status" >

                                            <label class="control-label col-sm-2" for Civilite> Civilité : </label>
                                            <div class="col-sm-2">
                                                <select class="form-control" name="Civilite" id="Civilite" required>
                                                    <option value="M" <?php if($compte ['Civilite']=='M') echo 'selected="selected"';?>>Monsieur</option>
                                                    <option value="Mme" <?php if($compte ['Civilite']=='Mme') echo 'selected="selected"';?>>Madame</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for PRENOM> Prenom : </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="PRENOM" id= "PRENOM" required value=<?php echo $compte['PRENOM']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for Nom> Nom : </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="Nom" id="Nom" required value=<?php echo $compte['Nom']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for Tel> Téléphone : </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="Tel" id="Tel" required value=<?php echo $compte['Tel']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for Email> E-mail : </label>
                                            <div class="col-sm-3">
                                                <input type="email" class="form-control" name="Email" id="Email" required value=<?php echo $compte['Email']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for Password> Mot de passe : </label>
                                            <div class="col-sm-3">
                                                <input type="password" class="form-control" name="Password" id="Password">
                                                <input type="hidden" class="form-control" name="Password_def" id="Password_def" value=<?php echo $compte['Password']; ?>>
                                            </div>
                                        </div><br>
                                        <?php
                                        $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Id_Client='$id' ");
                                        $addressList->execute();
                                        while($adr = $addressList->fetch()){
                                            ?>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Adresse> Adresse : </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="Adresse" id="Adresse" required value="<?php echo $adr['Adresse'];?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Ville> Ville : </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control"  name="Ville" id="Ville" required value=<?php echo $adr['Ville'];?>>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Postal_Code> Code Postal : </label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="Postal_Code" id="Postal_Code" required value=<?php echo $adr['Postal_Code'];?>>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Pays> Pays : </label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="Pays" id="Pays" required value=<?php echo $adr['Pays'];?>>
                                                </div>
                                            </div><br>
                                            <?php
                                        }
                                        }
                                        catch(PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }

                                        $bdd = null;
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" type="button" class="btn btn-info" value="Confirmer">
                                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>







             <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href=""  >
                  <img class="img-fluid" src="images/user_account2.png" alt="">
                  <div class="portfolio-box-caption">
                    <div class="portfolio-box-caption-content">
                      <div class="project-name">
                         <a4><p><strong>Consultez votre historique d'achat de nos produits</p></a4></strong>
                      </div>
                     <div class="project-category text-faded">
                         <a4><p><strong>Suivez l'état de vos achats</p></a4></strong>
                      </div>
                      <div class="project-name">
                         <a4><p><strong></p></a4></strong>
                      </div>
                    </div>
                  </div>
                </a>
              </div>



            </div>
          </div>
    </section>



<div class="jumbotron" align="center"  style="padding-top: 10px;padding-bottom: 10px;">
        <h2><strong>Nos best seller</strong></h2><br>
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


</div>


</body>

<footer>
    <?php include'footer.php';?>
</footer>
</html>
