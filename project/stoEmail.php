<?php
require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
require '/usr/share/php/libphp-phpmailer/class.smtp.php';
$mail = new PHPMailer(); 
$mail->IsSMTP();                              // send via SMTP
$mail->Host = "ssl://smtp.gmail.com";
$mail->SMTPAuth = true;                       // turn on SMTP authentication
$mail->Username = "semestroprojektasdd@gmail.com";        // SMTP username
$mail->Password = "Zxc123Zxc123";               // SMTP password
$webmaster_email = "semestroprojektasdd@gmail.com";       //Reply to this email ID
$email="44421u5@gmail.com";                // Recipients email ID
$name="Aloyzas";                              // Recipient's name
$mail->From = $webmaster_email;
$mail->Port = 465;
$mail->FromName = "Tomas";
$mail->AddAddress($email,$name);
$mail->Subject = "subject";
$mail->Body = "Hi,
This is the HTML BODY ";                      //HTML Body 
$mail->AltBody = "This is the body when user views in plain text format"; //Text Body 

if(!$mail->Send())
{
	echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
	echo "Message has been sent";
}
?>