<?php
include("../include/session.php");
if ($session->logged_in) {
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Automobiliai</title>
            <link href="../include/styles.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table width="100%"><tr><td>
             <center><h1>Automobilių pardavimas.</h1> </center>
                    </td></tr><tr><td> 
                        <?php
                        include("../include/meniu.php");
                        ?>              
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                                    Atgal į [<a href="showAuto.php">Automobiliu sarasa</a>]
                                </td></tr></table>               
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1>Automobilio nuotrauka</h1>
    <?php
	  $dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME)
			or die(mysql_error() . '<br><h1>Faile include/constants.php suveskite savo MySQLDB duomenis.</h1>');
	  //$id = $_GET['id'];

	  $sql = "SELECT picture FROM cars WHERE id=".$_GET['picId'];
      $result = mysqli_query($dbc, $sql);
	  $row = mysqli_fetch_assoc($result);
	echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['picture'] ) . '" />';

    ?>
                        </div> 
                        <br>                
                <tr><td>
                        <?php
                        include("../include/footer.php");
                        ?>
                    </td></tr>   
        </body>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: ../index.php");
}
?>