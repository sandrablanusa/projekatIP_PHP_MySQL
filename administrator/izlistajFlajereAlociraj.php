<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.flajeri";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);
        $selected = $_SESSION['idFlajera'] != $red['idFlajera'] ? "" : "selected";
        echo "<option ".$selected." value=".$red['idFlajera'].">".$red['naziv']."</option>";
    }

    $veza->close();

 ?>