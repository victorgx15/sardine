<?php
// Sous WAMP (Windows)
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
        <link rel="stylesheet" href="staff.css" />

        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title>La vieille sardine : Intranet</title>
    </head>

    <body>
        <!-- Corps de la page -->
        <h1 id="title_l">La Vieille Sardine : Site Intranet</h1>



        <form method="post" id="employee_form_login" action="">
        	<?php 
				if (isset($_POST['employeeEmail']) OR isset($_POST['employeePwd'])) {
				    $req = $bdd->prepare('SELECT id_client, password, status FROM compte WHERE email = :pseudo');
					$req->execute(array('pseudo' => $_POST['employeeEmail']));

					while ($resultat = $req->fetch()) {
						if(!$resultat OR hash('sha256', $_POST['employeePwd']) != $resultat['password']) {
							echo 'Mauvais identifiant ou mot de passe !';
						} else {
							session_start();
					        $_SESSION['id'] = $resultat['id_client'];
					        $_SESSION['email'] = $_POST['employeeEmail'];
					        $_SESSION['status'] = $resultat['status'];
					        if ($resultat['status'] == 'A') {
					        	header('Location: adminpage.php');
					        } else if ($resultat['status'] == 'E') {
					        	header('Location: Home.php');
					        }
					        
  							exit();
						}
					}
				}
				?>
        	<input type="email" name="employeeEmail" placeholder="Email employé"><br>
        	<input type="password" name="employeePwd" placeholder="Mot de passe"><br>
        	<input type="submit" value="Connexion" />
        </form>
    </body>
</html>