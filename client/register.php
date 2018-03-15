<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
</head>
<body>
<header>
    <?php include'header.php';?>        
</header>

<?php

if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
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
	$status="C";
	

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


        $stmts = $conn->prepare("INSERT INTO compte(Civilite,Nom,PRENOM,Tel,Tel2,Email,Password,Status) VALUES(?,?,?,?,?,?,?,?)");
        $stmts->bind_param("ssssssss", $civil, $uname,$prenom,$tel1, $tel2, $email, $password,$status);
        $res = $stmts->execute();//get result
        $stmts->close();

        $user_id = mysqli_insert_id($conn);
        if ($user_id > 0) {
            $_SESSION['user'] = $user_id; // set session et redirect vers index ;)
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: index.php");
                exit;
            }

        } else {
            $errTyp = "danger";
            $errMSG = "Un problème technique s est produit, Veuillez réessayer ultérieurement";
        }

    } else {
        $errTyp = "warning";
        $errMSG = "L email existe";
    }

}
?>

<div class="container">

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
                                                                
                                                                    <select name="civil" class="form-control">
                                                                        <option>Mll</option>
                                                                        <option>Mme</option>
                                                                        <option>Mr</option>
                                                                        
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
                        <input type="text" name="tel1" class="form-control" placeholder="Téléphone 1 *" required/>
                    </div>
                </div>
				 <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                        <input type="text" name="tel2" class="form-control" placeholder="Téléphone 2 ( facultatif )" required/>
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
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Mot de passe *"
                               required/>
                    </div>
                </div>

                <div class="checkbox">
                    <label><input type="checkbox" id="TOS" value="This"><a href="#">J'accepte les conditions</a></label>
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

        </form>
    </div>

</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/tos.js"></script>

</body>
</html>
