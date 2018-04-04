                <!-- Edit Client Modal -->
                <?php
                try {
                    $id=$_SESSION['user'];
                    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $accountInfo = $bdd->prepare("SELECT * FROM compte WHERE Id_Client = '$id'");
                    $accountInfo->execute();
                    $compte=$accountInfo->fetch();
                ?>
                <div class="modal fade" id="editAccountModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                <h4>Modifier un client</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post" id="edit_client" action="EditAccount.php">
                                    <div class="container">
                                        <div class="form-group">
                                            <input type="hidden" value="<?php  echo $id;?>" id= "id" name="id" >
                                            <input type="hidden" value="<?php  echo $compte['Status'];?>" id="Status" name="Status" >

                                            <label class="control-label col-sm-2" for Civilite> Civilité : </label>
                                            <div class="col-sm-2">
                                                <select class="form-control" name="Civilite" id="Civilite" required>
                                                    <option value="M" <?php if($compte ['Civilite']=='M') echo 'selected="selected"';?>>Monsieur</option>
                                                    <option value="Mme" <?php if($compte ['Civilite']=='Mme') echo 'selected="selected"';?>>Madame</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for PRENOM> Prenom : </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="PRENOM" id= "PRENOM" required value=<?php echo $compte['PRENOM']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for Nom> Nom : </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="Nom" id="Nom" required value=<?php echo $compte['Nom']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for Tel> Téléphone : </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="Tel" id="Tel" required value=<?php echo $compte['Tel']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for Email> E-mail : </label>
                                            <div class="col-sm-3">
                                                <input type="email" class="form-control" name="Email" id="Email" required value=<?php echo $compte['Email']; ?>>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for Password> Mot de passe : </label>
                                            <div class="col-sm-3">
                                                <input type="password" class="form-control" name="Password" id="Password">
                                                <input type="hidden" class="form-control" name="Password_def" id="Password_def" value=<?php echo $compte['Password']; ?>>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-sm-2"> Autorisation : </label>
                                            <div class="col-sm-3">
                                                <select class="form-control" name="Civilite" id="Civilite" required>
                                                    <option value="M">J'autorise l'envoi du catalogue à mon domicile</option>
                                                    <option value="Mme">Je n'autorise pas l'envoi du catalogue à mon domicile</option>
                                                </select>
                                            </div>
                                        </div>

                                        <br>

                                            <?php
                                        }
                                        catch(PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }

                                        $bdd = null;
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" type="button" class="btn btn-info" value="Confirmer">
                                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>