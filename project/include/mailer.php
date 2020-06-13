<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/usr/share/php/libphp-phpmailer/src/Exception.php';
require '/usr/share/php/libphp-phpmailer/src/PHPMailer.php';
require '/usr/share/php/libphp-phpmailer/src/SMTP.php';

class Mailer {

    /**
     * sendWelcome - Sends a welcome message to the newly
     * registered user, also supplying the username and
     * password.
     */
    function sendWelcome($user, $email, $pass) {
		
		
		$mail = new PHPMailer(); 
		$mail->IsSMTP();                              // send via SMTP
		$mail->Host = "ssl://smtp.gmail.com";
		$mail->SMTPAuth = true;                       // turn on SMTP authentication
		$mail->Username = "semestroprojektasdd@gmail.com";        // SMTP username
		$mail->Password = "Zxc123Zxc123";               // SMTP password
		$name=$user;                              // Recipient's name
		$mail->From = $webmaster_email;
		$mail->Port = 465;
		$mail->FromName = "Automobiliu_pardavimas";
		$mail->AddAddress($email,$name);
		$mail->Subject = "Registracija";
		$mail->Body = "Sveiki! Jūs užsiregistravote į Automobiliu pardavimo sistemą "
                . "su sekančiais duomenimis:\n\n"
                . "Vartotojo vardas: " . $user . "\n"
                . "Slaptažodis: " . $pass . "\n\n";
		if(!$mail->Send())
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else
		{
			echo "Message has been sent";
		}
		return $mail->Send();
    }

    /**
     * sendNewPass - Sends the newly generated password
     * to the user's email address that was specified at
     * sign-up.
     */
    function sendNewPass($user, $email, $pass) {
		$mail = new PHPMailer(); 
		$mail->IsSMTP();                              // send via SMTP
		$mail->Host = "ssl://smtp.gmail.com";
		$mail->SMTPAuth = true;                       // turn on SMTP authentication
		$mail->Username = "semestroprojektasdd@gmail.com";        // SMTP username
		$mail->Password = "Zxc123Zxc123";               // SMTP password
		$name=$user;                              // Recipient's name
		$mail->From = $webmaster_email;
		$mail->Port = 465;
		$mail->FromName = "Automobiliu_pardavimas";
		$mail->AddAddress($email,$name);
		$mail->Subject = "Naujas slaptažodis";
		$mail->Body = "Jūsų naujas slaptažodis:\n\n"
                . "Vartotojo vardas: " . $user . "\n"
                . "Naujas slaptažodis: " . $pass . "\n\n";
		if(!$mail->Send())
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else
		{
			echo "Message has been sent";
		}
		return $mail->Send();
    }

}

/* Initialize mailer object */
$mailer = new Mailer;
?>
