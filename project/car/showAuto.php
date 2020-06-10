<?php
include("../include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Parduodami automobiliai</title>
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
        <!-- <table class="center"><tr><td> -->
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
				<div style="text-align: center;color:green">    
					<h1>Automobiliai</h1>
					<form name="search_form" method="POST" action="showAuto.php">
						Paieska: <input type="text" name="search_box" value=""/>
						<input type="submit" name="search" value="Ieskoti...">
					</form>
    <?php
    $dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
                or die(mysql_error() . '<br><h1>Faile include/constants.php suveskite savo MySQLDB duomenis.</h1>');

    echo "<table style=\"margin: 0px auto;\" id=\"zinutes\">";
    echo "<tr><td>Modelis</td><td>Pavadinimas</td><td>Data</td><td>Miestas</td><td>Kaina</td><td>Nuotrauka</td></tr>";
	
    //  nuskaityti viska bei spausdinti 
    $sql = "SELECT * FROM cars";
	if(isset($_POST['search'])){
		$search_term = $_POST['search_box'];
		$sql .= " WHERE model = '{$search_term}' ";
		$sql .= " OR name = '{$search_term}' ";
		$sql .= " OR date = '{$search_term}' ";
		$sql .= " OR city = '{$search_term}' ";
		$sql .= " OR price = '{$search_term}' ";
	
	}
	
    $result = mysqli_query($dbc, $sql);
    // if (mysqli_num_rows($result) > 0)
    {while($row = mysqli_fetch_assoc($result))
        {
        echo "<tr><td>".$row['model']."</td><td>".$row['name']."</td><td>".$row['date']."</td><td>".$row['city']."</td><td>".$row['price']."</td>".
			"<td><a href='getImage.php?picId=".$row['id']."'>Rodyti</a></tr>";
        } 
    };
   echo "</table>";
    ?>
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