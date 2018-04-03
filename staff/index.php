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
        
        <link rel="stylesheet" href="css/staff.css" />
        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<style type="text/css">
			#employee_form_login {
				background: rgba(0,0,0,0.3);
				width: 200px;
				border-radius: 5px;
				padding: 10px;
				position: absolute;
				left: 50%; top: 50%;
				margin-left: -100px;
				margin-top: -100px;
				height: 160px;
			}
			body{ background-image: url("background.jpg"); }
			#employee_form_login input {
				width: 180px;
				padding: 10px;
				border: 1px solid black;
				border-radius: 5px;
				margin-bottom: 10px;
				height: 40px;				
			}
			#subBut {
				background: rgb(100,120,200);
				color: white;
				border: none;
				font-weight: bold;
			}
			#subBut:hover {
				background: rgb(20,20,200);
			}
		</style>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title>La vieille sardine : Intranet</title>
    </head>

    <body>
        <!-- Corps de la page -->
        <h1 id="title_l">La Vieille Sardine : Site Intranet</h1>
        <img src="images/logo1.png" style="position:relative;left:50%;margin-left: -120px;">


        <form method="post" id="employee_form_login" action="">
        	<?php 
				if (isset($_POST['employeeEmail']) OR isset($_POST['employeePwd'])) {
				    $req = $bdd->prepare('SELECT Id_client, Password, Status, Nom, PRENOM FROM compte WHERE email = :pseudo');
					$req->execute(array('pseudo' => $_POST['employeeEmail']));

					while ($resultat = $req->fetch()) {
						if(!$resultat OR hash('sha256', $_POST['employeePwd']) != $resultat['Password']) {
							echo 'Mauvais identifiant ou mot de passe !';
						} else {
					        $_SESSION['id'] = $resultat['Id_client'];
					        $_SESSION['PRENOM']= $resultat['PRENOM'];
					        $_SESSION['Nom']=$resultat['Nom'];
					        $_SESSION['email'] = $_POST['employeeEmail'];
					        $_SESSION['status'] = $resultat['Status'];
					        header('Location: Home.php');
  							exit();
						}
					}
				}
				?>
        	<input type="email" name="employeeEmail" placeholder="Email employé"><br>
        	<input type="password" name="employeePwd" placeholder="Mot de passe"><br>
        	<input type="submit" value="Connexion" id="subBut" />
        </form>
    </body>
</html>