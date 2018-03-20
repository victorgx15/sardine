<head>
    <?php include "header.php" ?>
    <style>
        td{
            padding:4px;
            vertical-align:top;
            width:50%
        }
        input {
            display:table-cell;
            width:100%
        }

    </style>
</head>

<body>

    <?php
        if(isset($_POST['ID_produit'])){
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=db;charset=utf8', 'root', '');

                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $prod = $_POST['ID_produit'];
                $bout = $_POST['ID_boutique'];
                $qte = $_POST['Quantite'];

                $test_query =  $bdd->prepare("SELECT COUNT(*) AS co FROM produitboutique WHERE pid = $prod AND bid = $bout");
                $test_query->execute();
                $res = $test_query->fetch();
                if($res['co'] == 1) {
                    $query="UPDATE produitboutique(pid, bid, quantite) SET quantite = quantite + $qte
                            WHERE pid = $prod AND bid = $bout";
                } else {
                    $query="INSERT INTO produitboutique(pid, bid, quantite) VALUES('$prod', '$bout', '$qte')";
                }
                $stmt = $bdd->prepare($query);
                $stmt->execute();

                echo "<script>alert('Produit ajouté avec succès'); window.location.href='Home.php'; window.location('Home.php')</script>";

            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $bdd = null;
    }
?>



<div class="jumbotron" align="center">
    <h2>Ajouter du stock</h2><br>
    <form method="post" id="product_add" action="AddStock.php">
        <table style="width:60%" >
            <tr>
                <td><input type="text" id="Designation" name="ID_produit" placeholder="ID produit" required></td>
                <td><input type="text" id="Marque" name="ID_boutique" placeholder="ID boutique" required></td>
            </tr>
            <tr>
                <td><input type="text" id="Famille" name="Quantite" placeholder="Quantite" required></td>
                <td><input type="submit" value="Confirmer" class="btn btn-success"></td>
            </tr>

        </table>
    </form>

</div>
</body>


