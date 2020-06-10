<?php
include("../include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
            <title>Mano paskyra</title>
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
            <table width="100%" ><tr><td>
             <center><h1>Automobilių pardavimas.</h1> </center>
            </td></tr><tr><td>  
                <?php
                //Jei vartotojas prisijungęs

                include("../include/meniu.php");
                ?>
                <table style="border-width: 2px; border-style: dotted;">
                    <tr><td>
                            Atgal į [<a href="../index.php">Pradžia</a>]
                        </td></tr></table>               
                <br> 
                <?php
                /* Requested Username error checking */
                if (isset($_GET['user'])) {
                    $req_user = trim($_GET['user']);
                } else {
                    $req_user = null;
                }
                if (!$req_user || strlen($req_user) == 0 || !preg_match("/^[0-9a-zA-Z ]*$/", $req_user) || !$database->usernameTaken($req_user)) {
                    echo "<br><br>";
                    die("Vartotojas nėra užsiregistravęs");
                }
				echo"<h1>Naudotojo informacija</h1>";
                echo "[<a href=\"useredit.php\">Redaguoti paskyrą</a>] &nbsp;&nbsp;";

                /* Display requested user information */
                $req_user_info = $database->getUserInfo($req_user);

                echo "<br><table border=1 style=\"text-align:left;\" cellspacing=\"0\" cellpadding=\"3\"><tr><td><b>Vartotojo vardas: </b></td>"
                . "<td>" . $req_user_info['username'] . "</td></tr>"
                . "<tr><td><b>E-paštas:</b></td>"
                . "<td>" . $req_user_info['email'] . "</td></tr></table><br>";
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
                ?>
				 <div>                   
				<h1>Naudotojo automobiliai</h1>
				<?php
				$dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
							or die(mysql_error() . '<br><h1>Faile include/constants.php suveskite savo MySQLDB duomenis.</h1>');
				
        		echo "[<a href=\"../car/addCar.php\">Pridėti automobilį</a>] &nbsp;&nbsp;";
				echo "<table style=\"margin: 0px auto;\" id=\"zinutes\">";
				echo "<tr><td>Modelis</td><td>Pavadinimas</td><td>Data</td><td>Miestas</td><td>Kaina</td><td>Veiksmai</td></tr>";

				//  nuskaityti viska bei spausdinti 
				$sql = "SELECT * FROM cars where username='".$session->userinfo['username']."'";
				$result = mysqli_query($dbc, $sql);
				// if (mysqli_num_rows($result) > 0)
				{while($row = mysqli_fetch_assoc($result))
					{
					echo "<tr><td>".$row['model']."</td><td>".$row['name']."</td><td>".$row['date']."</td><td>".$row['city']."</td><td>".$row['price']."</td>".
					"<td><a href=\"../car/editCar.php\">Redaguoti</a> | <a href='../process.php?dc=1&id=".$row['id']."' onclick='return confirm(\"Ar tikrai norite trinti?\");'>Trinti</a></td></tr>";
					} 
				};
			   echo "</table>";
				?>
			</div> 
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