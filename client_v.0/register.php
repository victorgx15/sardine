<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Création de compte</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
</head>
<body>
<header>
    <?php include'header.php';?>        
</header>

<?php

if (isset($_SESSION['user']) != "") {
    //header("Location: index.php");
}
include_once 'dbconnect.php';

if (isset($_POST['signup'])) {
	$civil = trim($_POST['civil']);
    $uname = trim($_POST['uname']); // Les variables pour la méthode Post
	$prenom = trim($_POST['prenom']);
	$tel1 = trim($_POST['tel1']);
	$tel2 = trim($_POST['tel2']);
    $email = trim($_POST['email']);
    $upass = trim($_POST['pass']);
    $upassConfirmation = trim($_POST['passConfirmation']);
    $autorisation = 0;
    $status="C";
    $Adresse = trim($_POST['Adresse']);
    $codePostal = trim($_POST['codePostal']);
    $Ville = trim($_POST['Ville']);
    $Pays = trim($_POST['Pays']);
    $statusAdresse="L";

	

    // hashage du mot de pass avec SHA256;
    $password = hash('sha256', $upass);

    // check si l'email existe ou pas lol
    $stmt = $conn->prepare("SELECT Email FROM compte WHERE Email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $count = $result->num_rows;

    if ($count == 0) { // Si email n'existe pas 
        if($upassConfirmation==$upass){

            $stmts = $conn->prepare("INSERT INTO compte(Civilite,Nom,PRENOM,Tel,Tel2,Email,Password,Status,Autorisation) VALUES(?,?,?,?,?,?,?,?,?)");
            $stmts->bind_param("sssssssss", $civil, $uname,$prenom,$tel1, $tel2, $email, $password,$status,$autorisation);
            $res = $stmts->execute();//get result
            $stmts->close();

?>

<div class="container">

<?php
            $user_id = mysqli_insert_id($conn);
            if ($user_id > 0) {
                //if the user account is succussefully created, add his address
                $stmts = $conn->prepare("INSERT INTO adresse(Pays,Ville,Adresse,Postal_Code,Id_Client,Status) VALUES(?,?,?,?,?,?)");
                $stmts->bind_param("ssssss", $Pays, $Ville,$Adresse,$codePostal, $user_id,$statusAdresse);
                $res = $stmts->execute();//get result
                $stmts->close();
                $_SESSION['user'] = $user_id; // set session et redirect vers index ;)
                if (isset($_SESSION['user'])) {
                ?>
                    <div class="form-group">
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-info-sign"></span>Votre compte a été créé avec succès !
                        </div>
                    </div>
                <?php
                }

            } else {
                $errTyp = "danger";
                $errMSG = "Un problème technique s'est produit, Veuillez réessayer ultérieurement";
            }

        }else{
            $errTyp = "warning";
            $errMSG = "La confirmation du mot de passe est incorrecte !";
        }



    } else {
        $errTyp = "warning";
        $errMSG = "L'émail que vous avez saisi existe déjà !";
    }

}
?>
    <div id="login-form">
        <form method="post" autocomplete="off">

            <div class="col-md-12">

                <div class="form-group">
                    <h2 class="">Créer un compte LaVieilleSardine</h2>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <?php
                if (isset($errMSG)) {

                    ?>
                    <div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <div class="input-group">
                        <label for="civil" name="civil" >Civilité *</label>
                        <select name="civil" class="form-control" style="height: 40px;">
                            <option>Madame</option>
                            <option>Monsieur</option>
                        </select>
    			 	</div>
                </div>
                      
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="uname" class="form-control" placeholder="Nom *" required/>
                    </div>
                </div>
				
				 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" name="prenom" class="form-control" placeholder="Prénom *" required/>
                    </div>
                </div>
				
				 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                        <input type="number" name="tel1" class="form-control" placeholder="Téléphone 1 *" required/>
                    </div>
                </div>
				 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                        <input type="number" name="tel2" class="form-control" placeholder="Téléphone 2 (facultatif)"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Email * exemple@exemple.com" required/>
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                        <input type="text" id="Adresse" name="Adresse" class="form-control" placeholder="Adresse" required/>
                    </div>
                </div>


                <div class="form-group">
                    <div class="input-group">
                        <div align="right" style="display: table-cell;vertical-align:middle;width:33.3%;">
                            <input type="number"  id="codePostal" name="codePostal"  class="form-control" placeholder="Code Postal" style="height: 40px;">
                        </div>

                        <div align="right" style="display: table-cell;vertical-align:middle;width:33.3%;">
                            <input type="text"  id="Ville" name="Ville"  class="form-control" style="height: 40px;">
                        </div>

                        <div align="right" style="display: table-cell;vertical-align:middle;width:33.3%;">
                            <select  id="Pays" name="Pays"  class="form-control" style="height: 40px;">
                                <option>France</option>
                                <option>Belgique</option>
                                <option>Angleterre</option>
                                <option>Hollande</option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Mot de passe *"
                               required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="passConfirmation" class="form-control" placeholder="confirmez votre mot de passe *"
                               required/>
                    </div>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" id="TOS" value="This"><a data-toggle="modal" data-target="#myModal">J'accepte les conditions (cliquez ici pour lire les conditions)</a></label>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" id="TOS" value="This"><a href="#">J'accepte de recevoir les catalogues de la marque</a></label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn    btn-block btn-primary" name="signup" id="reg">Inscription</button>
                </div>

                <div class="form-group">
                    <hr/>
                </div>

                <div class="form-group">
                    <a href="login.php" type="button" class="btn btn-block btn-success" name="btn-login">Vous avez un compte ?  Connexion</a>
                </div>

            </div>



<!-- Modal Condition de vente -->
<div id="myModal" class="modal fade" role="dialog" style="height: 500px;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <?php include("conditionsVente.php");?>
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div>

  </div>
</div>






        </form>
    </div>

</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/tos.js"></script>

</body>
</html>
