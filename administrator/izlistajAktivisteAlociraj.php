<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.aktivisti";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);
        $selected = $_SESSION['idAktiviste'] != $red['idAktiviste'] ? "" : "selected";
        echo "<option value=".$red['idAktiviste']." ".$selected." >".$red['ime']. " " .$red['prezime']."</option>";
    }

    $veza->close();

 ?>