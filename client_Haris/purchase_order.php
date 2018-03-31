<?php
session_start();

require('pdf_generator/fpdf.php');

class PDF extends FPDF
{

// En-tête
function Header()
{
    // Logo
    $this->Image('images/logo.png',10,6,30);
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(30,10,'Titre',1,0,'C');
    // Saut de ligne
    $this->Ln(20);
}


// Tableau coloré
function FancyTable($header)
{
    // Couleurs, épaisseur du trait et police grasse
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // En-tête
    $w = array(40, 35);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Restauration des couleurs et de la police
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Données
    $fill = false;

    foreach($_SESSION["cart"] as $k => $v) {
        $this->Cell($w[0],6,$k,'LR',0,'L',$fill);
        $this->Cell($w[1],6,number_format($v,0,',',' '),'LR',0,'R',$fill);

    }
    
    // Trait de terminaison
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
// Titres des colonnes
$header = array('Produit', 'Capitale');
// Chargement des données
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable($header);
$pdf->Output();
?>