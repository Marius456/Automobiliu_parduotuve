<?php
include("include/session.php");
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>IT projektas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>             
        <table  width="100%"><tr><td>
             <center><h1>Automobilių pardavimas.</h1> </center>
        </td></tr>
        <tr><td>  
            <?php
            //Jei vartotojas prisijungęs
            if ($session->logged_in) {
                include("include/meniu.php");
                ?>
                <div style="text-align:center; color:green">
                    <br><br>
                    <h1>Automobilių pardavimo sistema.</h1>
					<h1>Marius Žilgužis IFF-7/8</h1>
                </div><br>
                <?php
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
            } else {
                echo "<div align=\"center\">";
                if ($form->num_errors > 0) {
                    echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                }
                echo "<table class=\"center\"><tr><td>";
                include("include/loginForm.php");
                echo "</td></tr></table></div><br></td></tr>";
            }
            echo "<tr><td>";
            include("include/footer.php");
            echo "</td></tr>";
            ?>
        </td></tr>
</table>
</body>
</html>