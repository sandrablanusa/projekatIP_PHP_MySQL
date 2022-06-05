<?php

    $idUlice = $_SESSION['idUlice'];
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.ulica WHERE idUlice = '$idUlice' ";

    $rez = $veza->query($upit);

    if(mysqli_num_rows($rez) != 0) {

        $red = mysqli_fetch_array($rez);
        $brojevi = $red['nedodeljeniBrojevi'];

        $brojeviNiz = array_map('intval', explode(',', $brojevi));

        if(isset($brojevi)) {
            foreach($brojeviNiz as $br) {
                echo "<option>".$br."</option>";
            }
        }

    }

    $veza->close();
?>
