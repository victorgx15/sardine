<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require('pdf_generator/fpdf.php');
/*
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Write(5,'Hello India');


    $mail = new PHPMailer;
    $mail->isSMTP();                                // Set mailer to use SMTP
    $mail->Host = 'SmtpServer';                       // SMTP server
    $mail->SMTPAuth = 'true';                         // Enable SMTP authentication
    $mail->Username = 'SmtpUsername';                 // SMTP username
    $mail->Password = 'SmtpPassword';                 // SMTP password
    $mail->SMTPSecure = 'tls';                      // Enable TLS encryption, `ssl` also accepted
    $mail->From = 'FromEmail';
    $mail->Port = 587;                              // SMTP Port
    $mail->FromName  = 'testing';

    $subject="Hey";
    $body="hello";
    $emails="nizarouazzanichahdi17@gmail.com"
    $mail->Subject   = $subject;
    $mail->Body      = $body;
    $mail->AddAddress($emails);
    $mail->addStringAttachment($pdf->Output("S",'OrderDetails.pdf'), 'OrderDetails.pdf', $encoding = 'base64', $type = 'application/pdf');
    return $mail->Send();
*/

    //PHPMailer Object
$mail = new PHPMailer;

//From email address and name
$mail->From = "nizarouazzanichahdi17@gmail.com";
$mail->FromName = "Nizar";

//To address and name
$mail->addAddress("nizar.ouazzani-chahdi@dauphine.eu");
//$mail->addAddress("recepient1@example.com"); //Recipient name is optional

//Address to which recipient will reply
$mail->addReplyTo("nizarouazzanichahdi17@gmail.com");

//CC and BCC
$mail->addCC("cc@example.com");
$mail->addBCC("bcc@example.com");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}

?>
