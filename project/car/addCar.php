<?php
include("../include/session.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/usr/share/php/libphp-phpmailer/src/Exception.php';
require '/usr/share/php/libphp-phpmailer/src/PHPMailer.php';
require '/usr/share/php/libphp-phpmailer/src/SMTP.php';
  
if ($session->logged_in) {
    ?>    
    <html>  
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Pridėti automobilį</title>
            <link href="../include/styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>       
            <table  width="100%"><tr><td>
             <center><h1>Automobilių pardavimas.</h1> </center>
                    </td></tr><tr><td> 
                        <?php
                        include("../include/meniu.php");
                        ?>                   
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                                    Atgal į [<a href="../index.php">Pradžia</a>]
                                </td></tr></table>               
                        <br>                             
                            <?php
                         	$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
                                or die(mysql_error() . '<br><h1>Faile include/constants.php suveskite savo MySQLDB duomenis.</h1>');
                             if($_POST !=null){
                                $model = $_POST['model'];
                                $autoname =$_POST['name'];
                                $date = $_POST['date'];
                                $city = $_POST['city'];
                                $price = $_POST['price'];
								$usernam = $session->userinfo['username'];
								 
							/*	 
								$target_dir = "uploads/";
								$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
								$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
								 
								// Check if image file is a actual image or fake image
								if(isset($_POST["submit"])) {
									$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
									if($check !== false) {
										echo "File is an image - " . $check["mime"] . ".";
										$uploadOk = 1;
									} else {
										echo "File is not an image.";
										$uploadOk = 0;
									}
								}
							*/	 
								 
                                $sql = "INSERT INTO cars (model, name, date, city, price, username) VALUES ('$model', '$autoname','$date','$city','$price','$usernam')";
								 
                               if (mysqli_query($dbc, $sql)) echo "Įrašyta";
								 else echo $sql;
                                 
								$sql = "SELECT * FROM search_cars";
								$result = mysqli_query($dbc, $sql);
								$sentEmail = false;
								{while($row = mysqli_fetch_assoc($result))
									{
									if($row['model'] == $model && 
										$row['city'] == $city && 
										$row['maxPrice'] > $price && 
										$row['minPrice'] < $price)
										$sentEmail = true;

									//Neturi vieno kitamojo
									else if($row['model'] == null &&
										$row['city'] == $city && 
										$row['maxPrice'] > $price && 
										$row['minPrice'] < $price)
										$sentEmail = true;
									else if($row['model'] == $model && 
											$row['city'] == null &&
										$row['maxPrice'] > $price && 
										$row['minPrice'] < $price)
										$sentEmail = true;
									else if($row['model'] == $model && 
										$row['city'] == $city && 
										$row['maxPrice'] == null &&
										$row['minPrice'] < $price)
										$sentEmail = true;
									else if($row['model'] == $model && 
										$row['city'] == $city && 
										$row['maxPrice'] > $price && 
										$row['minPrice'] == null)
										$sentEmail = true;

									//Neturi dvieju kitamojo
									else if($row['model'] == null &&
										$row['city'] == null && 
										$row['maxPrice'] > $price && 
										$row['minPrice'] < $price)
										$sentEmail = true;
									else if($row['model'] == $model && 
											$row['city'] == null &&
										$row['maxPrice'] == null && 
										$row['minPrice'] < $price)
										$sentEmail = true;
									else if($row['model'] == $model && 
										$row['city'] == $city && 
										$row['maxPrice'] == null &&
										$row['minPrice'] == null)
										$sentEmail = true;
									else if($row['model'] == null && 
										$row['city'] == $city && 
										$row['maxPrice'] > $price && 
										$row['minPrice'] == null)
										$sentEmail = true;

									//Neturi triju kitamojo
									else if($row['model'] == null &&
										$row['city'] == null && 
										$row['maxPrice'] == null && 
										$row['minPrice'] < $price)
										$sentEmail = true;
									else if($row['model'] == $model && 
											$row['city'] == null &&
										$row['maxPrice'] == null && 
										$row['minPrice'] == null)
										$sentEmail = true;
									else if($row['model'] == null && 
										$row['city'] == $city && 
										$row['maxPrice'] == null &&
										$row['minPrice'] == null)
										$sentEmail = true;
									else if($row['model'] == null && 
										$row['city'] == null && 
										$row['maxPrice'] > $price && 
										$row['minPrice'] == null)
										$sentEmail = true; 
									if($sentEmail){
										 $mail = new PHPMailer(); 
										 $mail->IsSMTP();                              // send via SMTP
										$mail->Host = "ssl://smtp.gmail.com";
										$mail->SMTPAuth = true;                       // turn on SMTP authentication
										$mail->Username = "semestroprojektasdd@gmail.com";        // SMTP username
										$mail->Password = "Zxc123Zxc123";               // SMTP password
										$webmaster_email = "semestroprojektasdd@gmail.com";       //Reply to this email ID
										$email=$row['email'];
										$name="Kliente";                             // Recipient's name
										$mail->From = $webmaster_email;
										$mail->Port = 465;
										$mail->FromName = "Auromobiliu pardavimas";
										$mail->AddAddress($email,$name);
										$mail->Subject = "Rastas automobilis";
										$mail->Body = "Sveiki! Automobiliu pardavimo sistemoje radome jums automobili "
													. "su sekančiais duomenimis:\n\n"
													. "Modelis: " . $model . "\n"
													. "Pavadinimas: " . $autoname . "\n"
													. "Pagaminimo data: " . $date . "\n"
													. "Miestas: " . $city . "\n"
													. "Kaina: " . $price . "\n\n";               
										$mail->Send();
										echo "siusta";
									}
									} 
								};
                                }
                            ?>
                        <br> 
                <center><h3>Įveskite naujo automobilio duomenys</h3></center>		
<div class="container">
  <form method='post'>
	<div class="form-group col-lg-12" class="row">
  	<div class="column">
		  <label for="model">Modelis:</label>
   		  <input type="varchar" name="model" class="form-control input-sm">
	</div>
 	<div class="column">
		  <label for="name">Pavadinimas:</label>
   		  <input type="varchar" name="name" class="form-control input-sm">		  
	</div>
  	<div class="column">
		  <label for="date">Pagaminimo data:</label>
   		  <input type="int" name="date" class="form-control input-sm">
	</div>
  	<div class="column">
		  <label for="city">Miestas:</label>
   		  <input type="varchar" name="city" class="form-control input-sm">
	</div>
  	<div class="column">
		  <label for="price">Kaina:</label>
   		  <input type="varchar" name="price" class="form-control input-sm">
	</div>
<div action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
</div>
     <div class="form-group col-lg-2">
         <input type='submit' name='ok' value='Prideti' class="btnbtn-default">
     </div>
 </form>
</div>
                <tr><td>
                        <?php
                        include("../include/footer.php");
                        ?>
                    </td></tr>                       
            </table>     
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs arba prisijunges, bet ne Administratorius 
    //ar ne Valdytojas - užkraunamas pradinis puslapis   
} else {
    header("Location: ../index.php");
}
?>

