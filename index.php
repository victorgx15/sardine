<?php
// Sous WAMP (Windows)
$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
        <link rel="stylesheet" href="staff.css" />
        <title>La vieille sardine : Accueil Intranet</title>
    </head>

    <body>
        <!-- Corps de la page -->
        <h1 id="title_l">La Vieille Sardine : Site Intranet</h1>
        <form method="post" id="employee_form_login" action="./staffhome.html">
        	<?php 
				if (isset($_POST['employeeEmail']) OR isset($_POST['employeePwd'])) {
				    $req = $bdd->prepare('SELECT id_client, password, status FROM compte WHERE email = :pseudo');
					$req->execute(array('pseudo' => $_POST['employeeEmail']));
					$resultat = $req->fetch();

					while ($donnees = $resultat->fetch()) {
						if(!$resultat OR $_POST['employeePwd'] != $donnees['password']) {
							echo 'Mauvais identifiant ou mot de passe !';
						} else {
							session_start();
					        $_SESSION['id'] = $resultat['id'];
					        $_SESSION['email'] = $_POST['employeeEmail'];
					        $_SESSION['status'] = $resultat['status'];
					        header('Location: staffhome.php');
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