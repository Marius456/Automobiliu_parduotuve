<?php
include("../include/session.php");

if ($session->logged_in) {
    ?>    
    <html>  
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Redaguoti automobilį</title>
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
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM cars WHERE id='$id'";
                                $result = mysqli_query($dbc, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $model = $row['model']; $autoname = $row['name']; $date = $row['date']; $city = $row['city']; $price = $row['price'];
                                if($_POST['model'] !=null)
                                    $model = $_POST['model'];
                                if($_POST['name'] !=null)
                                    $autoname =$_POST['name'];
                                if($_POST['date'] !=null)
                                    $date = $_POST['date'];
                                if($_POST['city'] !=null)
                                    $city = $_POST['city'];
                                if($_POST['price'] !=null)
                                    $price = $_POST['price'];

                                $sql = "UPDATE cars SET model='$model', name='$autoname', date='$date', city='$city', price='$price' WHERE id='$id'";
                                if (mysqli_query($dbc, $sql)) echo "Įrašyta";
                                    else echo $sql;
                                }
                            ?>
                        <br> 
                <center><h3>Įveskite naujus automobilio duomenys</h3></center>		
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
         <input type='submit' name='ok' value='Pakeisti' class="btnbtn-default">
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
} else {
    header("Location: ../index.php");
}
?>

