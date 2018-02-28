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
				<form action="/action_page.php" autocomplete="off">
					<p>Rechercher un client: (needs to be changed so that drop down changes text-field type (refID, name, phone, email))</p>
					<select>
						<option value="refID">ref ID</option>
						<option value="name">nom</option>
						<option value="phonenumber">numéro de téléphone</option>
						<option value="email">e-mail</option>
					</select>
					<input type="text" placeholder="Search..." name="searchclient">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
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
                                <form method="post" id="client_register" action="staffhome.php">
                                    <fieldset>

                                        <label for civil> Civilité : </label>
                                        <select name="civil">
                                            <option value="M">Monsieur</option>
                                            <option value="Mme">Madame</option>
                                        </select><br>
                                        <label for firstname> Prenom : </label><input type="text" name="firstname" placeholder="ex. John"><br>
                                        <label for lastname> Nom : </label><input type="text" name="lastname" placeholder="ex. Smith"><br>
                                        <label for telephone> Téléphone : </label><input type="text" name="telephone" placeholder="01 01 02 03 04"><br>
                                        <label for email> E-mail : </label><input type="email" name="email" placeholder="johnsmith@email.com"><br>
                                        <label for username> Username : </label><input type="text" name="username" placeholder="ex. johnsmith88"><br>
                                        <label for password> Password : </label><input type="text" name="password" placeholder="ex. abc123"><br>
                                        <input type="submit" value="Inscrire" style="float: right;">
                                    </fieldset>
                                        <?php
                                    if (isset($_POST['email'])) {
                                        // Insertion
                                        $req = $bdd->prepare("INSERT INTO user(civil, firstname, lastname, telephone, email, password) VALUES(:civil, :firstname, :lastname, :telephone, :email, :password)");
                                        $req->execute(array('civil' => $_POST['civil'],
                                            'username' => $_POST['username'],
                                            'firstname' => $_POST['firstname'],
                                            'lastname' => $_POST['lastname'],
                                            'telephone' => $_POST['telephone'],
                                            'email' => $_POST['email'],
                                            'password' => hash('sha256', $_POST['password'])));
                                            echo "<script>alert('Sucès!');</script>";
                                    }else{
                                        echo "<script>alert('Echec!');</script>";
                                    }
                                    ?>

                                    <!-- TODO:
                                    	-Refaire toute ta table en francais (sorry :-/): user => compte, firstname => prenom, ...
                                    	-Integrer le 'status' dans la table compte, pour le Client tu diras status = 'C'

                                    <!--

									Voici ma correction
									-J'ai fait le cryptage du mot de passe

                                    <?php
                                    if (isset($_POST['email'])) {
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
                                    ?>
									-->

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
					<p> Rechercher un produit dans la catalogue (link will need to open in new tab, used to get refID of products):</p>
					<input type="text" placeholder="Search..." name="searchcatalog">
					<button type="submit"><i class="fa fa-search"></i></button>
				</form>
				<a href="catalog.html">Acceder directement à toute la catalogue</a> <br>
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