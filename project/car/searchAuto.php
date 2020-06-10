<?php
include("../include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Automobilio paieška</title>
            <link href="../include/styles.css" rel="stylesheet" type="text/css" />
        </head>
        <style>
        #zinutes {
            font-family: "Trebuchet MS", Arial; border-collapse: collapse; width: 70%;
        }
        #zinutes td {
            border: 1px solid #ddd; padding: 8px;
        }
        #zinutes tr:nth-child(even){background-color: #f2f2f2;}
        #zinutes tr:hover {background-color: #ddd;}
            .column {
                float: left;
                width: 33.33%;
                padding-right: 10px
            }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }
        </style>
        <body>
            <table  width="100%" >
                <tr><td>
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
    echo "<table style=\"margin: 0px auto;\" id=\"zinutes\">";    
    if($_POST !=null){
            $model = $_POST['model']; 
            $city =$_POST['city'];
            $minPrice = $_POST['minPrice'];
            $maxPrice = $_POST['maxPrice'];
            $email=$session->userinfo['email'];
            
            $sql = "INSERT INTO search_cars (model, city, minPrice, maxPrice, email) VALUES ('$model', '$city','$minPrice', '$maxPrice','$email')";
		if (!mysqli_query($dbc, $sql))  die ("Klaida įrašant:" .mysqli_error($dbc));
            }
                    //  nuskaityti viska bei spausdinti 
            echo "<tr><td>Modelis</td><td>Miestas</td><td>Maziausia kaina</td><td>Didziausia kaina</td><td>Veiksmai</td></tr>";
            $sql = "SELECT * FROM search_cars where email ='".$session->userinfo['email']."'";
            $result = mysqli_query($dbc, $sql);
            {while($row = mysqli_fetch_assoc($result))
                {
                echo "<tr><td>".$row['model']."</td><td>".$row['city']."</td><td>".$row['minPrice'].
                    "</td><td>".$row['maxPrice']."</td>";
				$id=$row['id'];
				     echo "<td><a href='../process.php?d=1&id=$id' onclick='
					 		return confirm(\"Ar tikrai norite Šalinti?\");'>Šalinti</a></td></tr>\n";
   
                } 
            };
            echo "</table>";
        ?>
                        <div style="text-align: left;color:green">                   
                            <h1>Stebėti</h1>
                            <form method='post'>
								Modelis:<input name='model' type='text'><br><br>
								Miestas:<input name='city' type='text'><br><br>
								Mažiausia Kaina: <input name='minPrice' type='text'><br><br>
								Didžiausia Kaina: <input name='maxPrice' type='text'><br><br>
								<input type='submit' name='ok' value='Patvirtinti'>
							</form>                  
                        </div> 
                        <br>  
                <tr><td>
                        <?php
                        include("../include/footer.php");
                        ?>
                    </td></tr>      
            </table>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: ../index.php");
}
?>