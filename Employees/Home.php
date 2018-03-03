<!DOCTYPE html>
<?php
// Sous WAMP (Windows)
// Will be changed to correspond to proper database later
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
?>
<html>
    <head>

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            * {box-sizing: border-box;}
            body {
                margin: 0;
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>

        <link rel="stylesheet" href="staff.css" />
        <title>La vieille sardine : Accueil Intranet</title>
    </head>

    <body>
        <!-- Corps de la page -->
        <h1 id="title_l">La Vieille Sardine</h1>
        <div class="container">	
			<p> Note: layout will need to be re-designed to be more user-friendly and to look nicer</p>
			<div class = "search-container">
				<form name="search" method="post" action="SearchClient.php" autocomplete="off">
					<p>Rechercher un client:</p>
					<select name="searchmethod" id="searchmethod">
						<option value="id">ref ID</option>
                        <option value="username">username</option>
						<option value="lastName">nom de famille</option>
						<option value="telephone">numéro de téléphone</option>
						<option value="email">e-mail</option>
					</select>
					<input type="text" placeholder="Search..." name="searchclient" id="searchclient">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>

                <!-- A réfléchir si on veut la barre de recherche sur l'autre page (au pire je rajouterais plus tard)-->
                <a href="ClientList.php">Parcourir la liste des clients</a> <br>
                <button type="button" data-toggle="modal" data-target="#newClient">Enregistrer un nouveau client</button>

                <!-- Modal -->
                <div class="modal fade" id="newClient" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Enregistrer un nouveau client</h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="client_register" action="AddClient.php">
                                    <fieldset>

                                        <label for gender> Civilité : </label>
                                        <select name="civilite" id="civilite">
                                            <option value="M">Monsieur</option>
                                            <option value="Mme">Madame</option>
                                        </select><br>
                                        <label for firstname> Prenom : </label><input type="text" name="firstName" id= "firstName" placeholder="ex. John"><br>
                                        <label for lastname> Nom : </label><input type="text" name="lastName" id="lastName" placeholder="ex. Smith"><br>
                                        <label for telephone> Téléphone : </label><input type="text" name="telephone" id="telephone" placeholder="01 01 02 03 04"><br>
                                        <label for email> E-mail : </label><input type="email" name="email" id="email" placeholder="johnsmith@email.com"><br>
                                        <label for username> Username : </label><input type="text" name="username" id="username" placeholder="ex. johnsmith88"><br>
                                        <label for password> Password : </label><input type="password" name="password" id="password" placeholder="ex. abc123"><br>
                                        <input type="submit" value="Inscrire" style="float: right;">
                                    </fieldset>

                                    <!-- J'avais fait en fonction de ce que je voyais dans le db.sql que j'ai trouvé sur fb/github et j'ai resté cohérent avec ceci
                                         (db.sql -> users est en anglais de ce que je vois...)
                                         je suis pas trop sûr de comment exactement tu préfère le changer donc on discuterais
                                    <!-- TODO:
                                    	-Refaire toute ta table en francais (sorry :-/): user => compte, firstname => prenom, ...
                                    	-Integrer le 'status' dans la table compte, pour le Client tu diras status = 'C'

                                    <!--

									Voici ma correction
									-J'ai fait le cryptage du mot de passe
									-->

                                    <?php
/*                                    if (isset($_POST['email'])) {
                                        // Insertion
                                        $req = $bdd->prepare("INSERT INTO compte(nom, prenom, telephone, email, civilite, password, status)
                                        						VALUES(:lastname, :firstname, :telephone, :email, :civilite, :password, 'C')");
                                        $req->execute(array('lastname' => $_POST['lastname'],
                                            'firstname' => $_POST['firstname'],
                                            'telephone' => $_POST['telephone'],
                                            'email' => $_POST['email'],
                                            'civilite' => $_POST['civil'],
                                            'password' => hash('sha256', $_POST['password'])));
                                            echo "<script>alert('Sucès!');</script>";
                                    }
                                    */?>


                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
			</div>
			<div class="search-container">
				<form action="/action_page.php" autocomplete="off">
					<p> Rechercher un produit dans le stock: (open stock page with searched product highlighted)</p>
					<input type="text" placeholder="Search..." name="searchstock">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
				<a href="stock.html">Acceder directement à tout le stock</a> <br>
			</div>
		</div>
    </body>
</html