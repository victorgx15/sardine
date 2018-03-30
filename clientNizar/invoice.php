<?php
// Appel de la librairie FPDF
require('pdf_generator/fpdf.php');
require_once 'dbconnect.php';
session_start();
$res;
if (isset($_SESSION['user'])) {
    $res = $conn->query("SELECT * FROM compte WHERE ID_Client=" . $_SESSION['user']);
    }
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

// Création de la class PDF
class PDF extends FPDF {
    // Header
    function Header() {
        // Logo
        $this->Image('images/logo1.png',8,2,20);
        $this->setFont('','B',16);
        $this->Cell(60);
	    // Titre
	    $this->Cell(60,10,'BON DE COMMANDE',1,0,'C');
        // Saut de ligne
        $this->Ln(20);

    }
    // Footer
    function Footer() {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        $this->setFont('','B',10);
        // Adresse
        $this->Cell(196,5,utf8_decode('Nous contacter'),0,0,'C');
        $this->Ln();
        $this->Cell(196,5,utf8_decode('5 Rue Jean Jaurès - 56937 Villeneuve la Vieille'),0,0,'C');
        $this->Ln();
        $this->Cell(196,5,utf8_decode('0672189203 - contact@lavieillesardine.com '),0,0,'C');
    }
}


// Activation de la classe
$pdf = new PDF('P','mm','A4');
$pdf->SetFont('Helvetica','',11);
$pdf->AddPage();
$pdf->SetTextColor(0);

//$req = "SELECT id, id_client, date_com, reglement FROM table_commandes WHERE id=".$_GET['id'];
//$rep = mysqli_query($db, $req);
//$row = mysqli_fetch_array($rep);

$row =array("id"=>"562297", "date_com"=>"2018/02/02", "reglement"=>"espèce");

// Infos de la commande calées à gauche
$pdf->Text(8,38,utf8_decode('N° de commande : '.$row['id']));
$pdf->Text(8,43,utf8_decode('Date de commande : '.$row['date_com']));
$pdf->Text(8,48,utf8_decode('Mode de règlement : '.$row['reglement']));
$pdf->Text(8,53,utf8_decode('Date d\'émission du bon : '.Date("Y/n/j")));


// Infos du client calées à droite
$pdf->Text(120,38,utf8_decode('Client : '.$userRow['PRENOM']).' '.utf8_decode($userRow['Nom']));
$pdf->Text(120,43,utf8_decode('Status : '.$userRow['Status']));



// Position de l'entête à 10mm des infos (48 + 10)
$position_entete = 58;

function entete_table($position_entete){
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte
    $pdf->SetY($position_entete);
    $pdf->SetX(8);
    $pdf->Cell(158,8,utf8_decode('Désignation'),1,0,'L',1);
 	$pdf->SetX(96); // 8 + 96
    $pdf->Cell(30,8,utf8_decode('Référence'),1,0,'C',1);  
 	$pdf->SetX(126); // 8 + 96
    $pdf->Cell(30,8,utf8_decode('Prix Unitaire'),1,0,'C',1);  
    $pdf->SetX(156); // 8 + 96
    $pdf->Cell(20,8,utf8_decode('Quantité'),1,0,'C',1);
    $pdf->SetX(176); // 104 + 10
    $pdf->Cell(24,8,utf8_decode('Prix'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne
}
entete_table($position_entete);




$eltsPanier=array();
foreach($_SESSION['cart'] as $key => $item) {
	array_push($eltsPanier, $key);
}	

$eltsPanier=implode(',', $eltsPanier);
$res = $conn->query("SELECT * FROM produit where Id_Produit IN ($eltsPanier)");
// Liste des détails
$prixTotal=0;
$position_detail = 66; // Position à 8mm de l'entête
while ($rowProduct = mysqli_fetch_array($res)) {
	$pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->SetFont('Helvetica','',8);
    $pdf->MultiCell(158,8,utf8_decode($rowProduct['Designation']),1,'L');
    $pdf->SetY($position_detail);
    $pdf->SetX(96);
    $pdf->MultiCell(30,8,$rowProduct['Ref'],1,'C');
    $pdf->SetFont('Helvetica','',11);
    $pdf->SetY($position_detail);
    $pdf->SetX(126);
    $pdf->MultiCell(30,8,$rowProduct['Prix'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(156);
    $pdf->MultiCell(20,8,$_SESSION['cart'][$rowProduct["Id_Produit"]],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(176);
    $pdf->MultiCell(24,8,$rowProduct["Prix"]*$_SESSION['cart'][$rowProduct["Id_Produit"]],1,'R');
    $prixTotal+=$rowProduct["Prix"]*$_SESSION['cart'][$rowProduct["Id_Produit"]];
    $position_detail += 8;	
}

	
function facturation($position,$userAdress,$prixTotal){
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte
    $pdf->SetY($position);

	$pdf->SetX(8);
    $pdf->Cell(88,8,utf8_decode('Adresse de livraison : '),1,0,'L',1);

 	$pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Total de ma commande : '),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8,utf8_decode($prixTotal.' euros'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne

	
	$pdf->SetFillColor(256); // Couleur des filets
	$pdf->SetX(8);
	
    $pdf->Cell(88,8,utf8_decode($userAdress['Adresse']),1,0,'L',1);
    $pdf->SetY($position+8*2);
    $pdf->SetX(8);
    $pdf->Cell(88,8,$userAdress['Postal_Code'].' '.$userAdress['Ville'].' '.$userAdress['Pays'],1,0,'L',1);

    $pdf->SetY($position+8);
    $pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Remise éventuelle à déduire : '),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8,utf8_decode(100*reduction($prixTotal,'C').'%'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne


    $pdf->SetFillColor(221); // Couleur des filets
		

    $pdf->SetY($position+8*2);
    $pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Montant à déduire : '),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8,utf8_decode($prixTotal*(reduction($prixTotal,'C')).' euros'),1,0,'C',1);
    $prixTotalApresRemise=$prixTotal*(1-reduction($prixTotal,'C'));
    $pdf->Ln(); // Retour à la ligne


	$pdf->SetX(8);
    $pdf->Cell(88,8,utf8_decode('Mode de paiement :'),1,0,'L',1);


    $pdf->SetFillColor(256); // Couleur des filets
    $pdf->SetY($position+8*3);
    $pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Frais de livraison : '),1,0,'C',1);  
    $pdf->SetX(176); 
    if($prixTotal>126){
	    $pdf->Cell(24,8,utf8_decode('Offert'),1,0,'C',1);
    }else{
    	$pdf->Cell(24,8,utf8_decode('7,32 euros'),1,0,'C',1);
    	$prixTotalApresRemise+=7.32;
    	
    }
    $pdf->Ln(); // Retour à la ligne


	$pdf->SetX(8);
    $pdf->Cell(88,8,utf8_decode('Espèce/Paypal/CB/Chèque'),1,0,'L',1);
 	$pdf->SetY($position+8*5);
    $pdf->SetX(8);
    $pdf->Cell(88,8,utf8_decode('N° d\'autorisation : 51293'),1,0,'L',1);

    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetY($position+8*4);
    $pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8+8,utf8_decode('Montant total à payer : '),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8+8,utf8_decode($prixTotalApresRemise.' euros'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne
}

$res = $conn->query("SELECT * FROM adresse WHERE Status='L' AND ID_Client=" . $_SESSION['user']);
$userAdress = mysqli_fetch_array($res, MYSQLI_ASSOC);
facturation($position_detail+10,$userAdress,$prixTotal);



function reduction($prixtotal,$status) {
	$remise=0;
	
	if($status=="V" || $status=="C"){
	if($prixtotal<229){
		$remise=0;
		}else{
		
		if($prixtotal>229 && $prixtotal<=381){
				$remise=0.03;
        }elseif ($prixtotal>381 && $prixtotal<=1220){
			$remise=0.05;
        }elseif( $prixtotal>1220){
    	 	$remise=0.07;
		}
	}	
	}else{
		if($prixtotal<1220){
		$remise=0;
	}elseif($status=="P"){
		$remise=0;
		if($prixtotal>1220 && $prixtotal<=2020){
				$remise=0.07;
		}elseif ($prixtotal>2020 && $prixtotal<=3010){
			$remise=0.09;
		}elseif( $prixtotal>3010){
			$remise=0.11;
	    }
	}
	}
	    return $remise;
							
}
 


// Nom du fichier
$nom = 'Facture-'.$row['id'].'.pdf';

// Création du PDF
//$pdf->Output($nom,'D');
$pdf->Output();

?>