<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('header.php'); ?>
    <style>
        th {
            cursor: pointer;
            text-align: center;
        }

        input {
            width: 80%;
            box-sizing: border-box;
        }
    </style>
</head>
<body>

<div class="container">


</div>

<?php
if(isset($_SESSION['status'])){
    if($_SESSION['status'] == 'A') {


try {

    /*$bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="SELECT id, civilite, Nom, PRENOM, Tel, Email FROM user ";
    $stmt = $bdd->prepare($query);
    $stmt->execute();



    echo "<table class='table table-striped table-bordered table-hover' id='staffTable'>";
    echo "<tr><th onclick='sortTable(0)' >Id</th><th onclick='sortTable(1)'>Civilite</th><th onclick='sortTable(2)'>Nom</th><th onclick='sortTable(3)'>Prénom</th><th onclick='sortTable(4)'>Téléphone</th><th onclick='sortTable(5)'>E-mail</th><th> Action </th></tr>";

    while($compte = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        $id=$compte['id'];
        foreach($compte as $value) {
            echo "<td>{$value}</td>";
        }
        echo "<td> <a href='#editClient<?php echo $id;?>'  data-toggle='modal'  class='btn btn-info' >Modifier </a>              <input type='button' class='btn btn-danger btn-xs' value='Supprimer'></td>";
        include 'modal_EditClient.php';
        echo "</tr>";
    }
    echo "</table>";*/
    ?>
    <div class="container" style="width:100%; padding-bottom: 10px">
        <br><div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><i class="icon-user icon-large"></i>&nbsp;Liste des Employés</strong>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newStaff">
            <span class="glyphicon glyphicon-plus"></span> Nouveau Employé
        </button>
        <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#searchFilter">
            <span class="glyphicon glyphicon-search"></span> Filtrer
        </button>
        <script>
            function filterCol(k) {
                var input, filter, table, tr, td, i;
                input = document.getElementById("filterCol"+k.toString());
                filter = input.value.toUpperCase();
                table = document.getElementById("staffTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[k];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
    </div>

    <div class="container" style="width:100% ">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="staffTable">


            <thead>
            <tr>
                <th style="width:10%"; onclick='sortTable(0)' >ID_Client</th>
                <th style="width:5%"; onclick='sortTable(1)'>Civilite</th>
                <th style="width:20%"; onclick='sortTable(2)'>Prenom</th>
                <th style="width:20%"; onclick='sortTable(3)'>Nom</th>
                <th style="width:15%"; onclick='sortTable(4)'>Tel</th>
                <th style="width:10%"; onclick='sortTable(5)'>Email</th>

                <th> Action </th>
            </tr>
            <tr id="searchFilter" class="collapse">
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol0" onkeyup="filterCol(0)"></th>
                <th style="text-align:center; word-break:break-all; "> </th>
                <th style="text-align:center; word-break:break-all; "> <input style="text-align:center;" type="text" id="filterCol2" onkeyup="filterCol(2)"></th>
                <th style="text-align:center; word-break:break-all; "> <input style="text-align:center;" type="text" id="filterCol3" onkeyup="filterCol(3)"></th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol4" onkeyup="filterCol(4)"> </th>
                <th style="text-align:center; word-break:break-all; "><input style="text-align:center;" type="text" id="filterCol5" onkeyup="filterCol(5)"></th>
                <th style="text-align:center; word-break:break-all; display:inline-block"> </th>
            </tr>
            </thead>
            <tbody>
            <!-- New Employee Modal -->
            <div class="modal fade" id="newStaff" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" text-align="center">Enregistrer un nouveau employé</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" method="post" id="add_staff" action="AddAccount.php">
                                <div class="container">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Status> Status : </label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="Status" id="Status">
                                                <option disabled selected value style="display:none"></option>
                                                <option value="E">Employé</option>
                                                <option value="A">Administrateur</option>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Civilite> Civilité : </label>
                                        <div class="col-sm-2">
                                            <select class="form-control" name="Civilite" id="Civilite">
                                                <option disabled selected value style="display:none"></option>
                                                <option value="M">Monsieur</option>
                                                <option value="Mme">Madame</option>
                                            </select>
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for PRENOM> Prenom : </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="PRENOM" id= "PRENOM">
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Nom> Nom : </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="Nom" id="Nom" >
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Tel> Téléphone : </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="Tel" id="Tel" >
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Email> E-mail : </label>
                                        <div class="col-sm-3">
                                            <input type="email" class="form-control" name="Email" id="Email" >
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Password> Mot de passe : </label>
                                        <div class="col-sm-3">
                                            <input type="password" class="form-control" name="Password" id="Password">
                                        </div>
                                    </div><br><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Adresse> Adresse : </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="Adresse" id="Adresse">
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Ville> Ville : </label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control"  name="Ville" id="Ville">
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Postal_Code> Code Postal : </label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="Postal_Code" id="Postal_Code">
                                        </div>
                                    </div><br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for Pays> Pays : </label>
                                        <div class="col-sm-2">
                                            <select name="Pays" id="Pays" class="form-control">
                                                <option value="Afganistan">Afghanistan</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bonaire">Bonaire</option>
                                                <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                                <option value="Brunei">Brunei</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Canary Islands">Canary Islands</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Channel Islands">Channel Islands</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos Island">Cocos Island</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote DIvoire">Cote D'Ivoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Curaco">Curacao</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czech Republic">Czech Republic</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="East Timor">East Timor</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands">Falkland Islands</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France" selected>France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Ter">French Southern Ter</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Great Britain">Great Britain</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Hawaii">Hawaii</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran">Iran</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea North">Korea North</option>
                                                <option value="Korea Sout">Korea South</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Laos">Laos</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libya">Libya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macau">Macau</option>
                                                <option value="Macedonia">Macedonia</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Midway Islands">Midway Islands</option>
                                                <option value="Moldova">Moldova</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Nambia">Nambia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherland Antilles">Netherland Antilles</option>
                                                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                                <option value="Nevis">Nevis</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau Island">Palau Island</option>
                                                <option value="Palestine">Palestine</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Phillipines">Philippines</option>
                                                <option value="Pitcairn Island">Pitcairn Island</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Republic of Montenegro">Republic of Montenegro</option>
                                                <option value="Republic of Serbia">Republic of Serbia</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russia">Russia</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="St Barthelemy">St Barthelemy</option>
                                                <option value="St Eustatius">St Eustatius</option>
                                                <option value="St Helena">St Helena</option>
                                                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                                <option value="St Lucia">St Lucia</option>
                                                <option value="St Maarten">St Maarten</option>
                                                <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                                                <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                                                <option value="Saipan">Saipan</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="Samoa American">Samoa American</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syria">Syria</option>
                                                <option value="Tahiti">Tahiti</option>
                                                <option value="Taiwan">Taiwan</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania">Tanzania</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Erimates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States of America">United States of America</option>
                                                <option value="Uraguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Vatican City State">Vatican City State</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Vietnam">Vietnam</option>
                                                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                                <option value="Wake Island">Wake Island</option>
                                                <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zaire">Zaire</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div><br><br>
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
            <?php
            $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');
            $result = $bdd->prepare("SELECT * FROM compte WHERE Status='E' OR Status='A'");
            $result->execute();

            for($i=0; $compte = $result->fetch(); $i++){
                $id=$compte['ID_Client'];
                ?>
                <tr>
                    <td style="text-align:center; word-break:break-all;"> <?php if($compte['Status']=='A'){ echo "<font color='red'>"; echo $compte ['ID_Client']; echo "</font>";}else{echo $compte ['ID_Client'];} ?></td>
                    <td style="text-align:center; word-break:break-all; width:5%;"> <?php if($compte['Status']=='A'){ echo "<font color='red'>"; echo $compte ['Civilite']; echo "</font>";}else{echo $compte ['Civilite'];} ?></td>
                    <td style="text-align:center; word-break:break-all;"> <?php if($compte['Status']=='A'){ echo "<font color='red'>"; echo $compte ['PRENOM']; echo "</font>";}else{echo $compte ['PRENOM'];} ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php if($compte['Status']=='A'){ echo "<font color='red'>"; echo $compte ['Nom']; echo "</font>";}else{echo $compte ['Nom'];} ?></td>
                    <td style="text-align:center; word-break:break-all; "> <?php if($compte['Status']=='A'){ echo "<font color='red'>"; echo $compte ['Tel']; echo "</font>";}else{echo $compte ['Tel'];} ?></td>
                    <td style="text-align:center; word-break:break-all; width:20%;"> <?php if($compte['Status']=='A'){ echo "<font color='red'>"; echo $compte ['Email']; echo "</font>";}else{echo $compte ['Email'];} ?></td>
                    <td style="text-align:center; word-break:break-all; width:10%">
                        <a href="#edit<?php echo $id; ?>" data-toggle="modal" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                        <a href="#delete<?php echo $id;?>"  data-toggle="modal"  class="btn btn-danger" ><span class="glyphicon glyphicon-trash"></span> </a>
                    </td>


                    <!-- Edit Employee Modal -->
                    <div class="modal fade" id="edit<?php  echo $id;?>" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-backdrop="static" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title" text-align="center">Modifier un employé</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="post" id="edit_account" action="EditAccount.php">
                                        <div class="container">
                                            <div class="form-group">
                                                <input type="hidden" value="<?php  echo $id;?>" id= "id" name="id">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for Status> Status : </label>
                                                    <div class="col-sm-2">
                                                        <select class="form-control" name="Status" id="Status">
                                                            <option disabled selected value style="display:none"></option>
                                                            <option value="E" <?php if($compte ['Status']=='E') echo 'selected="selected"';?>>Employé</option>
                                                            <option value="A" <?php if($compte ['Status']=='A') echo 'selected="selected"';?>>Administrateur</option>
                                                        </select>
                                                    </div>
                                                </div><br>

                                                <label class="control-label col-sm-2" for Civilite> Civilité : </label>
                                                <div class="col-sm-2">
                                                    <select class="form-control" name="Civilite" id="Civilite" required>
                                                        <option value="M" <?php if($compte ['Civilite']=='M') echo 'selected="selected"';?>>Monsieur</option>
                                                        <option value="Mme" <?php if($compte ['Civilite']=='Mme') echo 'selected="selected"';?>>Madame</option>
                                                    </select>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for PRENOM> Prenom : </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="PRENOM" id= "PRENOM" required value=<?php echo $compte['PRENOM']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Nom> Nom : </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="Nom" id="Nom" required value=<?php echo $compte['Nom']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Tel> Téléphone : </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="Tel" id="Tel" required value=<?php echo $compte['Tel']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Email> E-mail : </label>
                                                <div class="col-sm-3">
                                                    <input type="email" class="form-control" name="Email" id="Email" required value=<?php echo $compte['Email']; ?>>
                                                </div>
                                            </div><br>
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for Password> Mot de passe : </label>
                                                <div class="col-sm-3">
                                                    <input type="password" class="form-control" name="Password" id="Password">
                                                    <input type="hidden" class="form-control" name="Password_def" id="Password_def" value=<?php echo $compte['Password']; ?>>
                                                </div>
                                            </div><br><br>
                                            <?php
                                            $addressList = $bdd->prepare("SELECT * FROM adresse WHERE Id_Client='$id' ");
                                            $addressList->execute();
                                            while($adr = $addressList->fetch()){
                                                ?>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for Adresse> Adresse : </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" name="Adresse" id="Adresse" required value="<?php echo $adr['Adresse'];?>">
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for Ville> Ville : </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control"  name="Ville" id="Ville" required value=<?php echo $adr['Ville'];?>>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for Postal_Code> Code Postal : </label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="Postal_Code" id="Postal_Code" required value=<?php echo $adr['Postal_Code'];?>>
                                                    </div>
                                                </div><br>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-2" for Pays> Pays : </label>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="Pays" id="Pays" required value=<?php echo $adr['Pays'];?>>
                                                    </div>
                                                </div><br><br>
                                                <?php
                                            }
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



                    <!-- Delete Employee Modal -->
                    <div id="delete<?php  echo $id;?>" class="modal fade" role="dialog">
                        <div class="modal-header">
                            <h3>Delete</h3>
                        </div>
                        <div class="modal-body">
                            <p><div style="font-size:larger;" class="alert alert-danger">Etes-vous sûr de vouloir effacer les données de <b style="color:red;"><?php echo $compte['PRENOM']." ".$compte['Nom'] ; ?></b> ? <br> Cette action n'est pas réversible</p>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-inverse" data-dismiss="modal" >Non</button>
                            <a href="DeleteStaff.php<?php echo '?id='.$id; ?>" class="btn btn-danger">Oui</a>


                        </div>
                    </div>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>


<?php
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$bdd = null;
echo "</table>";

}else{
        echo "<script>alert('Vous n\'avez pas la permission d\'accéder cette page'); window.location='Home.php'</script>";
    }
}
?>

<script>

    $('.modal').on('hidden.bs.modal', function(){
        $(this).find('form')[0].reset();
    });

    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("staffTable");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc";
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.getElementsByTagName("TR");
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /*check if the two rows should switch place,
                based on the direction, asc or desc:*/
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                //Each time a switch is done, increase this count by 1:
                switchcount ++;
            } else {
                /*If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again.*/
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

</body>
</html>
