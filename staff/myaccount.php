<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
?>

<form method="post" action="myaccount.php">
	<?php

		if(isset($_POST['email'])) {
			$req3 = $bdd->prepare("	UPDATE compte SET email = :email, nom = :nom, prenom = :prenom, tel = :tel, tel2 = :tel2
									WHERE id_client = :id_c");
			$req3->execute(array('email' => $_POST['email'], 'nom' => $_POST['lastName'], 'prenom' => $_POST['firstName'],
									'tel' => $_POST['tel'], 'tel2' => $_POST['tel2'], 'id_c' => $_SESSION['id']
								));
		}


		if(isset($_POST['addr'])) {
			$req3 = $bdd->prepare("	INSERT INTO adresse(id_client, adresse, postal_code, ville, pays, status)
									VALUES(:id_client, :adresse, :postal, :ville, :pays, 'P')");
			$req3->execute(array('id_client' => $_SESSION['id'],
									'adresse' => $_POST['addr'],
									'postal' => $_POST['cp'],
									'ville' => $_POST['city'],
									'pays' => $_POST['country']
								));
		}



		$req = $bdd->query("SELECT email, nom, prenom, tel, tel2 FROM compte WHERE id_Client = ".$_SESSION['id']."");
		while ($data = $req->fetch()) {
		
	?>
	<label for="email">Email</label>
	<input type="email" name="email" value="<?php echo $data['email']; ?>"><br>

	<label for="lastName">Nom</label>
	<input type="text" name="lastName" value="<?php echo $data['nom']; ?>"><br>

	<label for="firstName">Prenom</label>
	<input type="text" name="firstName" value="<?php echo $data['prenom']; ?>"><br>

	<label for="tel">Telephone</label>
	<input type="text" name="tel" value="<?php echo $data['tel']; ?>"><br>

	<label for="tel2">Telephone 2</label>
	<input type="text" name="tel2" value="<?php echo $data['tel2']; ?>"><br>


	<?php
		$req2 = $bdd->query("SELECT COUNT(*) AS cc FROM adresse WHERE id_Client = ".$_SESSION['id']."");
		$data2 = $req2->fetch();
		if ($data2['cc'] == 0) {
	?><br>

	<label for="addr">Adresse</label>
	<input type="text" name="addr"><br>

	<label for="cp">Code Postal</label>
	<input type="text" name="cp"><br>

	<label for="city">Ville</label>
	<input type="text" name="city"><br>

	<label for="country">Pays</label>
	<input type="text" name="country"><br>

	<?php } else {

		$req21 = $bdd->query("SELECT adresse, postal_code, ville, pays FROM adresse WHERE id_Client = ".$_SESSION['id']."");
		$data21 = $req21->fetch();
	?>

	<label for="addr">Adresse</label>
	<input type="text" name="addr" value="<?php echo $data21['adresse']; ?>"><br>

	<label for="cp">Code Postal</label>
	<input type="text" name="cp" value="<?php echo $data21['postal_code']; ?>"><br>

	<label for="city">Ville</label>
	<input type="text" name="city" value="<?php echo $data21['ville']; ?>"><br>

	<label for="country">Pays</label>
	<input type="text" name="country" value="<?php echo $data21['pays']; ?>"><br>

	<?php }} ?>

	<input type="submit" value="Modifier">
<form>