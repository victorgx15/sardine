<head>
    <?php
    include('header.php');
    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $id=$_SESSION['id'];
    ?>

    <style>
        input[readonly] {
            cursor: pointer;
        }
        input[disabled] {
            cursor: pointer;
        }
    </style>
</head>

<div class="jumbotron" align="center">
    <h2>Informations de votre compte</h2><br>
    <form class="form-horizontal" method="post" id="edit_account" action="">
        <?php
        $stmt = $bdd->query("SELECT Email, Nom, PRENOM, Tel, Civilite, Password FROM compte WHERE Id_Client = ".$_SESSION['id']."");
        while ($client = $stmt->fetch()) {
        ?>
        <div class="container">
            <div class="form-group">
                <input type="hidden" value="<?php  echo $id;?>" id= "id" name="id" >
                <label class="control-label col-sm-2" for Civilite> Civilité : </label>
                <div class="col-sm-2">
                    <select class="form-control" name="Civilite" id="Civilite" required <?php if(!$_GET['Edit']) echo 'disabled'?>>
                        <option value="M" <?php if($client['Civilite']=='M') echo 'selected="selected"';?>>Monsieur</option>
                        <option value="Mme" <?php if($client['Civilite']=='Mme') echo 'selected="selected"';?>>Madame</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for PRENOM> Prenom : </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="PRENOM" id= "PRENOM" required <?php if(!$_GET['Edit']) echo 'readonly'?> value=<?php echo $client['PRENOM']; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for Nom> Nom : </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="Nom" id="Nom" required <?php if(!$_GET['Edit']) echo 'readonly'?> value=<?php echo $client['Nom']; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for Tel> Téléphone : </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="Tel" id="Tel" required <?php if(!$_GET['Edit']) echo 'readonly'?> value=<?php echo $client['Tel']; ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for Email> E-mail : </label>
                <div class="col-sm-3">
                    <input type="email" class="form-control" name="Email" id="Email" required <?php if(!$_GET['Edit']) echo 'readonly'?> value=<?php echo $client['Email']; ?>>
                </div>
            </div><br>
            <?php
            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Id_Client='$id' ");
            $addressList->execute();
            while($adr = $addressList->fetch()){
                ?>
                <div class="form-group">
                    <label class="control-label col-sm-2" for Adresse> Adresse : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="Adresse" id="Adresse" required <?php if(!$_GET['Edit']) echo 'readonly'?> value="<?php echo $adr['Adresse'];?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for Ville> Ville : </label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control"  name="Ville" id="Ville" required <?php if(!$_GET['Edit']) echo 'readonly'?> value=<?php echo $adr['Ville'];?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for Postal_Code> Code Postal : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="Postal_Code" id="Postal_Code" required <?php if(!$_GET['Edit']) echo 'readonly'?> value=<?php echo $adr['Postal_Code'];?>>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for Pays> Pays : </label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="Pays" id="Pays" required <?php if(!$_GET['Edit']) echo 'readonly'?> value=<?php echo $adr['Pays'];?>>

                    </div>
                </div>
                <?php
            }
            ?>
            <?php
            if(!$_GET['Edit']){
                ?>
                <a href="MyAccount.php?Edit=1" class="btn btn-info">Modifier les informations</a> <br><br>
                <?php
            }
            ?>
        </div>
        <div class="modal-footer">
            <input type="submit" type="button" class="btn btn-success" value="Confirmer" <?php if(!$_GET['Edit']) echo " style='display: none'"?>>
            <a href="MyAccount.php?Edit=0" class="btn btn-danger" <?php if(!$_GET['Edit']) echo " style='display: none'"?>>Annuler</a>
        </div>
        <?php }
        ?>
    </form>

</div>