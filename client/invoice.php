<?php
// Appel de la librairie FPDF
require('pdf_generator/fpdf.php');

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
        $this->setFont('','B',12);
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
$pdf->Text(8,43,utf8_decode('Date commande : '.$row['date_com']));
$pdf->Text(8,48,utf8_decode('Mode de règlement : '.$row['reglement']));

//$req1 = "SELECT nom, prenom, adresse, code_postal, ville FROM table_clients WHERE id=".$row['id_client'];
//$rep1 = mysqli_query($db, $req1);
//$row1 = mysqli_fetch_array($rep1);

$row1 =array("nom"=>"Ouazzani", "prenom"=>"Nizar", "adresse"=>"There", "code_postal"=>"75000", "ville"=>"Paris","type"=>"Particulier");

// Infos du client calées à droite
$pdf->Text(120,38,utf8_decode('Client : '.$row1['prenom']).' '.utf8_decode($row1['nom']));
$pdf->Text(120,43,utf8_decode('Status : '.$row1['type']));



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


// Liste des détails
$position_detail = 66; // Position à 8mm de l'entête

//$req2 = "SELECT libelle, qte, prix_ht FROM table_details WHERE id_commande=1";
//$rep2 = mysqli_query($db, $req2);
//while ($row2 = mysqli_fetch_array($rep2)) {

$row2 =array("libelle"=>"Boite de sardine", "ref"=>"20129102","qte"=>"2","prixu"=>"12", "prix_ht"=>"150");
 
	$pdf->SetFont('Helvetica','',9);

	$pdf->SetY($position_detail);
    $pdf->SetX(8);
    $pdf->MultiCell(158,8,utf8_decode($row2['libelle']),1,'L');
    $pdf->SetY($position_detail);
    $pdf->SetX(96);
    $pdf->MultiCell(30,8,$row2['ref'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(126);
    $pdf->MultiCell(30,8,$row2['prixu'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(156);
    $pdf->MultiCell(20,8,$row2['qte'],1,'C');
    $pdf->SetY($position_detail);
    $pdf->SetX(176);
    $pdf->MultiCell(24,8,$row2['prix_ht'],1,'R');
    $position_detail += 8;

	$pdf->SetFont('Helvetica','',11);

  


function facturation($position){
    global $pdf;
    $pdf->SetDrawColor(183); // Couleur du fond
    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetTextColor(0); // Couleur du texte
    $pdf->SetY($position);

	$pdf->SetX(8);
    $pdf->Cell(88,8,utf8_decode('Adresse de livraison'),1,0,'L',1);

 	$pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Total de ma commande'),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8,utf8_decode('100 euros'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne

	
	$pdf->SetFillColor(256); // Couleur des filets
	$pdf->SetX(8);
    $pdf->Cell(88,8,utf8_decode('8 Rue Jean Jack 75016 - Digicode 2536A'),1,0,'L',1);

    $pdf->SetY($position+8);
    $pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Remise éventuelle à déduire : '),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8,utf8_decode('10%'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne


    $pdf->SetFillColor(221); // Couleur des filets
	

    $pdf->SetY($position+8*2);
    $pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Montant à déduire : '),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8,utf8_decode('10 euros'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne


	$pdf->SetX(8);
    $pdf->Cell(88,8,utf8_decode('Mode de paiement :'),1,0,'L',1);


    $pdf->SetFillColor(256); // Couleur des filets
    $pdf->SetY($position+8*3);
    $pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Frais de livraison : '),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8,utf8_decode('7,32 euros'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne


	$pdf->SetX(8);
    $pdf->Cell(88,8,utf8_decode('Espèce/Paypal/CB/Chèque'),1,0,'L',1);


    $pdf->SetFillColor(221); // Couleur des filets
    $pdf->SetY($position+8*4);
    $pdf->SetX(116); // 8 + 96
    $pdf->Cell(60,8,utf8_decode('Montant total à payer : '),1,0,'C',1);  
    $pdf->SetX(176); 
    $pdf->Cell(24,8,utf8_decode('117,32 euros'),1,0,'C',1);
    $pdf->Ln(); // Retour à la ligne
}
facturation($position_detail+10);


 

/*while ($row2) {
   
}
*/
// Nom du fichier
$nom = 'Facture-'.$row['id'].'.pdf';

// Création du PDF
//$pdf->Output($nom,'D');
$pdf->Output();

?>