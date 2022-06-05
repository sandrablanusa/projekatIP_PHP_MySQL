<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.ulica";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);
        $selected = $_SESSION['idUlice'] != $red['idUlice'] ? "" : "selected";
        echo "<option value=".$red['idUlice']." ".$selected." >".$red['ulica']."</option>";
    }

    $veza->close();

    session_destroy();
 ?>