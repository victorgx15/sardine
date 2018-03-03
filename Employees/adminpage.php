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
        <style>
* {box-sizing: border-box;}

body {
  margin: auto;
  width: 1000px;
  font-family: Arial, Helvetica, sans-serif;
}

#employee_register, #employee_search {
	background: grey;
	width:500px;
}

#divid {
	width:100%;
}

#divid td {
	border: 1px solid black;
	width: 500px;
}

#product_add {
	background: grey;
}
</style>
        <title>La vieille sardine : Accueil Intranet</title>
    </head>

    <body>
        <!-- Corps de la page -->
        <h1 id="title_l">La Vieille Sardine : Site Intranet</h1>
        
        <?php
        if(isset($_SESSION['status'])){
        	if($_SESSION['status'] == 'A') {
        
        ?>
        <table id="divid">
    		<tr>
    			<td>
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
									'email' => $_POST['email'], 'civilite' => $_POST['civilite'], 'password' => hash('sha256', 'root11')));
								echo 'Inscription faite';
							}
						?>
			        </form>
    			</td>

    			<td>
    				<form method="post" id="product_add" action="adminpage.php">
			        	Ajouter un produit<br>

			        	<input type="text" name="designation" placeholder="Designation"><input type="text" name="brand" placeholder="Marque"><br>
			        	<input type="text" name="family" placeholder="Famille"><input type="text" name="range" placeholder="Gamme"><br>
			        	<input type="text" name="weight" placeholder="Poids en gramme"><input type="text" name="boxes" placeholder="Nombre de boites"><br>
			        	<input type="text" name="destination" placeholder="Destination"><input type="text" name="price" placeholder="Prix en euros"><br>
			        	<input type="text" name="img_url" placeholder="URL de l'image"><input type="text" name="description" placeholder="description"><br>
			        	<input type="text" name="refref" placeholder="Reference"><input type="submit" value="Ajouter"><br>

			        	<?php 
							if (isset($_POST['designation'])) {
								// Insertion
								$req = $bdd->prepare("	INSERT INTO produit(designation, marque, famille, gamme, poids, nombre_boites, destination, prix, url_image, description, ref)
														VALUES(:designation, :marque, :famille, :gamme, :poids, :nombre_boites, :destination, :prix, :url_image, :description, :ref)");
								$req->execute(array(
											'designation' => $_POST['designation'],
											'marque' => $_POST['brand'],
											'famille' => $_POST['family'],
											'gamme' => $_POST['range'],
											'poids' => $_POST['weight'],
											'nombre_boites' => $_POST['boxes'],
											'destination' => $_POST['destination'],
											'prix' => $_POST['price'],
											'url_image' => $_POST['img_url'],
											'description' => $_POST['description'],
											'ref' => $_POST['refref'],
										));
								echo 'Produit ajoute';
							}
						?>
			        </form>
    			</td>
    		</tr>

    		<tr>
    			<td>
    				<form method="post" id="employee_search" action="adminpage.php">
			        	Rechercher un employe<br>
			        	<input type="text" name="lastNameS" placeholder="Nom"><input type="submit" value="Rechercher" />
			        	<?php 
							if (isset($_GET['compteDelete'])) {
								// Selection
								$req = $bdd->query('DELETE FROM compte WHERE id_client = \''. $_GET['compteDelete'] .'\'');
								echo 'Compte supprime';
							}
						?><br>

						<?php 
							if (isset($_POST['lastNameS'])) {
								// Selection
								$req = $bdd->query('SELECT id_client, nom, prenom, email FROM compte WHERE status = \'E\' AND nom = \''. $_POST['lastNameS'] .'\'');

								while ($data = $req->fetch()) {
									echo 'Nom : ' . $data['nom'] . ', Prenom : ' . $data['prenom'] . ', Email : ' . $data['email'] .
									' | <a href="adminpage.php?compteDelete='. $data['id_client'] . '">Supprimer</a>';
								}
							}
						?>
			        </form>
    			</td>

    			<td>
    				<form method="post" id="product_search" action="adminpage.php">
			        	Rechercher un produit<br>
			        	<input type="text" name="productDesignation" placeholder="Designation"><input type="submit" value="Rechercher" />
			        	<?php 
							if (isset($_GET['productName'])) {
								// Selection
								$req = $bdd->query('DELETE FROM produit WHERE id_produit = \''. $_GET['productName'] .'\'');
								echo 'Produit retire';
							}
						?><br>

						<?php 
							if (isset($_POST['productDesignation'])) {
								// Selection
								$req = $bdd->query('SELECT id_produit, designation, prix FROM produit WHERE designation = \''. $_POST['productDesignation'] .'\'');

								while ($data = $req->fetch()) {
									echo 'Designation : ' . $data['designation'] . ', Prix : ' . $data['prix'].
									' | <a href="adminpage.php?productName='. $data['id_produit'] . '&act=del">Supprimer</a><br>';
								}
							}
						?>
			        </form>
    			</td>
    		</tr>

    	</table>

        <?php
        	}}
        ?>
        <!-- 

        <div>
        	<input type="text" name="qte" placeholder="Quantite"><br>
        	<input type="text" name="couloir" placeholder="Couloir">
        	<input type="text" name="etagere" placeholder="Etagere"><br>
        	<input type="text" name="travee" placeholder="Travee">
        </div>
    -->
    </body>
</html>