                <!-- Edit Client Modal -->
                <?php
                    include_once 'dbconnect.php';
                    $id=$_SESSION['user'];

                    if (isset($_POST['editaddress'])) {
                        $Adresse=$_POST['Adresse'];
                        $Postal_Code=$_POST['Postal_Code'];
                        $Ville=$_POST['Ville'];
                        $Pays=$_POST['Pays'];
                        $statusAdresse="L";

                        
                $stmts = $conn->prepare("INSERT INTO adresse(Pays,Ville,Adresse,Postal_Code,Id_Client,Status) VALUES(?,?,?,?,?,?)");
                $stmts->bind_param("ssssss", $Pays, $Ville,$Adresse,$Postal_Code, $id,$statusAdresse);
                $res = $stmts->execute();//get result
                $stmts->close();

                    }



                try {
                    $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $accountInfo = $bdd->prepare("SELECT * FROM compte WHERE Id_Client = '$id'");
                    $accountInfo->execute();
                    $compte=$accountInfo->fetch();
                ?>
                <div class="modal fade" id="editAddressModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                <h4>Modifier mes adresses</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" method="post">
                                    <div class="container">
                                        <div class="form-group">

                                            <div class="col-sm-5">
                                                <select  id="Pays" name="Pays"  class="form-control" style="height: 40px; width: 100%;">
                                                <?php
                                                    $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Id_Client='$id' "); //pour les boutiques le status sera 'B' et l'Id_client correspondra à l'ID_Boutique
                                                    $addressList->execute();
                                                    while($adr = $addressList->fetch()){
                                                ?>
                                                    <option value=""><?php echo $adr['Adresse']." ".$adr['Postal_Code']." ".$adr['Ville']." ".$adr['Pays'];?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                            </div>

                                        </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for Adresse>- Détails de la nouvelle adresse - </label>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Adresse> Adresse : </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="Adresse" id="Adresse" required >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Ville> Ville : </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control"  name="Ville" id="Ville" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Postal_Code> Code Postal : </label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="Postal_Code" id="Postal_Code" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Pays> Pays : </label>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control" name="Pays" id="Pays" required>
                                                </div>
                                            </div><br>



                                            <?php
                                        
                                        }
                                        catch(PDOException $e) {
                                            echo "Error: " . $e->getMessage();
                                        }

                                        $bdd = null;
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" type="button" name="editaddress" class="btn btn-info" value="Confirmer">
                                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>