<?php
// Sous WAMP (Windows)
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- En-tête de la page -->
        <meta charset="utf-8" />
        <link rel="stylesheet" href="staff.css" />
        <style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

#employee_register, #employee_search {
	background: grey;
	width:500px;
}
</style>
        <title>La vieille sardine : Accueil Intranet</title>
    </head>

    <body>
        <!-- Corps de la page -->
        <h1 id="title_l">La Vieille Sardine : Site Intranet</h1>
        <form method="post" id="employee_register" action="adminpage.php">
        	Inscrire un employe<br>
        	
			<select name="civilite">
	           <option value="M">Monsieur</option>
	           <option value="Mme">Madame</option>
       		</select><input type="email" name="email" placeholder="Email"><br>
        	<input type="text" name="firstName" placeholder="Prenom"><input type="text" name="lastName" placeholder="Nom"><br>
        	<input type="text" name="telephone" placeholder="Telephone"><input type="submit" value="Inscrire" /><br>
        	<?php 
				if (isset($_POST['email'])) {
					// Insertion
					$req = $bdd->prepare("INSERT INTO compte(nom, prenom, telephone, email, civilite, password, status) VALUES(:nom, :prenom, :telephone, :email, :civilite, :password, 'E')");
					$req->execute(array('nom' => $_POST['lastName'], 'prenom' => $_POST['firstName'], 'telephone' => $_POST['telephone'],
						'email' => $_POST['email'], 'civilite' => $_POST['civilite'], 'password' => 'root11'));
					echo 'Inscription faite';
				}
			?>
        </form>
<br>
        <form method="post" id="employee_search" action="adminpage.php">
        	Rechercher un employe<br>
        	<input type="text" name="lastNameS" placeholder="Nom"><input type="submit" value="Rechercher" /><br>
        </form>

        <div>
        	<?php 
				if (isset($_POST['lastNameS'])) {
					// Selection
					$req = $bdd->query('SELECT id_client, nom, prenom, email FROM compte WHERE nom = \''. $_POST['lastNameS'] .'\'');

					while ($data = $req->fetch()) {
						echo 'Nom : ' . $data['nom'] . ', Prenom : ' . $data['prenom'] . ', Email : ' . $data['email'] .
						' | <a href="adminpage.php?compteDelete='. $data['id_client'] . '">Supprimer</a>';
					}
				}
			?>
        </div>
    </body>
</html>