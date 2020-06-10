<?php
//Formuojamas meniu.
if (isset($session) && $session->logged_in) {
    ?>
    <table width=100% border="0" cellspacing="1" cellpadding="3" class="meniu">
        <?php
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>$session->username</b> <br>";
        echo "</td></tr><tr><td>";
        echo "[<a href=\" http://localhost/project/user/userinfo.php?user=$session->username\">Mano paskyra</a>] &nbsp;&nbsp;"
        . "[<a href=\"http://localhost/project/car/showAuto.php\">Automobiliai</a>] &nbsp;&nbsp;"
        . "[<a href=\"http://localhost/project/car/searchAuto.php\">Stebėjimas</a>] &nbsp;&nbsp;";
       //Administratoriaus sąsaja rodoma tik administratoriui
        if ($session->isAdmin()) {
            echo "[<a href=\"http://localhost/project/admin/admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"http://localhost/project/process.php\">Atsijungti</a>]";
        echo "</td></tr>";
        ?>
    </table>
    <?php
}//Meniu baigtas
?>
