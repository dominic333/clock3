<?
require_once('class.phpmailer.php');
$mail = new PHPMailer();				
$mail->IsSMTP();					
$mail->SMTPAuth = true; 
$mail->Username = "smtp_flexi"; 
$mail->Password = "1xaUvCpfPANkM"; 
//$mail->SMTPDebug = 2;
$mail->Host     = "mailgun.securesvr.net";
$mail->Port       = "587";





?>
