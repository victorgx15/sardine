<?php
// Appel de la librairie FPDF
require('pdf_generator/fpdf.php');
require_once 'dbconnect.php';
session_start();
$res;

$id_cmd=$_GET['id_cmd'];
$id_prd=$_GET['id_prd'];

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
        $this->setFont('','B',14);
        $this->Cell(60);
	    // Titre
	    $this->Cell(60,10,'BON RETOUR PRODUIT',1,0,'C');
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



// Infos de la commande calées à gauche
$pdf->SetFont('Helvetica','',14);
$pdf->Text(8,30,utf8_decode('- - - - - - - - - - - - - - - - - - - - PARTIE RESERVÉE AU CLIENT - - - - - - - - - - - - - - - - - - - -'));
$pdf->SetFont('Helvetica','',11);
$pdf->Text(8,38,utf8_decode('N° de commande : '.$id_cmd));
$pdf->Text(8,43,utf8_decode('Date d\'émission du bon : '.Date("Y/n/j")));


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
    $pdf->Cell(96,8,utf8_decode('Commande N° '),1,0,'C',1);
 	$pdf->SetX(104); // 8 + 96
    $pdf->Cell(96,8,utf8_decode('Produit N°'),1,0,'C',1);  
 	$pdf->SetX(192); // 8 + 96
    $pdf->Ln(); // Retour à la ligne
}
entete_table($position_entete);


$position_detail = 66; // Position à 8mm de l'entête

$pdf->SetFillColor(256); // Couleur des filets

$pdf->SetY($position_detail);
$pdf->SetX(8);
$pdf->Cell(96,8,utf8_decode($id_cmd),1,0,'C',1);
$pdf->SetX(104); // 8 + 96
$pdf->Cell(96,8,utf8_decode($id_prd),1,0,'C',1);  
$pdf->SetX(192); // 8 + 96
$pdf->Ln(); // Retour à la ligne



function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5){
    global $pdf;

    $wide = $baseline;
    $narrow = $baseline / 3 ; 
    $gap = $narrow;

    $barChar['0'] = 'nnnwwnwnn';
    $barChar['1'] = 'wnnwnnnnw';
    $barChar['2'] = 'nnwwnnnnw';
    $barChar['3'] = 'wnwwnnnnn';
    $barChar['4'] = 'nnnwwnnnw';
    $barChar['5'] = 'wnnwwnnnn';
    $barChar['6'] = 'nnwwwnnnn';
    $barChar['7'] = 'nnnwnnwnw';
    $barChar['8'] = 'wnnwnnwnn';
    $barChar['9'] = 'nnwwnnwnn';
    $barChar['A'] = 'wnnnnwnnw';
    $barChar['B'] = 'nnwnnwnnw';
    $barChar['C'] = 'wnwnnwnnn';
    $barChar['D'] = 'nnnnwwnnw';
    $barChar['E'] = 'wnnnwwnnn';
    $barChar['F'] = 'nnwnwwnnn';
    $barChar['G'] = 'nnnnnwwnw';
    $barChar['H'] = 'wnnnnwwnn';
    $barChar['I'] = 'nnwnnwwnn';
    $barChar['J'] = 'nnnnwwwnn';
    $barChar['K'] = 'wnnnnnnww';
    $barChar['L'] = 'nnwnnnnww';
    $barChar['M'] = 'wnwnnnnwn';
    $barChar['N'] = 'nnnnwnnww';
    $barChar['O'] = 'wnnnwnnwn'; 
    $barChar['P'] = 'nnwnwnnwn';
    $barChar['Q'] = 'nnnnnnwww';
    $barChar['R'] = 'wnnnnnwwn';
    $barChar['S'] = 'nnwnnnwwn';
    $barChar['T'] = 'nnnnwnwwn';
    $barChar['U'] = 'wwnnnnnnw';
    $barChar['V'] = 'nwwnnnnnw';
    $barChar['W'] = 'wwwnnnnnn';
    $barChar['X'] = 'nwnnwnnnw';
    $barChar['Y'] = 'wwnnwnnnn';
    $barChar['Z'] = 'nwwnwnnnn';
    $barChar['-'] = 'nwnnnnwnw';
    $barChar['.'] = 'wwnnnnwnn';
    $barChar[' '] = 'nwwnnnwnn';
    $barChar['*'] = 'nwnnwnwnn';
    $barChar['$'] = 'nwnwnwnnn';
    $barChar['/'] = 'nwnwnnnwn';
    $barChar['+'] = 'nwnnnwnwn';
    $barChar['%'] = 'nnnwnwnwn';

    $pdf->SetFont('Arial','',10);
    $pdf->Text($xpos, $ypos + $height + 4, $code);
    $pdf->SetFillColor(0);

    $code = '*'.strtoupper($code).'*';
    for($i=0; $i<strlen($code); $i++){
        $char = $code[$i];
        if(!isset($barChar[$char])){
            $pdf->Error('Invalid character in barcode: '.$char);
        }
        $seq = $barChar[$char];
        for($bar=0; $bar<9; $bar++){
            if($seq[$bar] == 'n'){
                $lineWidth = $narrow;
            }else{
                $lineWidth = $wide;
            }
            if($bar % 2 == 0){
                $pdf->Rect($xpos, $ypos, $lineWidth, $height, 'F');
            }
            $xpos += $lineWidth;
        }
        $xpos += $gap;
    }
}

$pdf->Text(8+68,90,utf8_decode('Code d\'autorisation retour produit :'));
Code39(80,95,'ROSA'.$id_prd.$id_cmd,1,10);
$pdf->Text(8,115,utf8_decode('Merci d\'apposer l\'étiquette de retour sur le produit retourné.'));

$pdf->Image('images/ciseaux.png',8,120,8);
$pdf->Text(8+8,125,utf8_decode('- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -'));

$pdf->SetFont('Helvetica','',14);
$pdf->Text(8,140,utf8_decode('- - - - - - - - - - - - - - - - - - - PARTIE RESERVÉE AU LIVREUR - - - - - - - - - - - - - - - - - - - -'));
$pdf->SetFont('Helvetica','',11);
$pdf->Text(8,150,utf8_decode('Ce colis est à livrer à l\'adresse ci-dessous :'));

$pdf->SetDrawColor(183); // Couleur du fond
$pdf->SetFillColor(221); // Couleur des filets
$pdf->SetTextColor(0); // Couleur du texte
$pdf->SetY(160);
$pdf->SetX(8+48);
$pdf->Cell(96,8*2,utf8_decode('- Entrepôt centrale de LaVieilleSardine -'),1,0,'C',1);
$pdf->SetY(160+8*2);
$pdf->SetX(8+48);
$pdf->Cell(96,8*2,utf8_decode('5 Rue Jean Jaurès - 56937 Villeneuve la Vieille'),1,0,'C',1);

// Nom du fichier
$nom = 'Retour-'.$id_cmd.$id_prd.'.pdf';
// Création du PDF
$pdf->Output($nom,'D');
$pdf->Output();

?>