<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.aktivisti";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);

        $ukupnoBrojeva = 0;
        if(!is_null($red['listaBrojeva'])) {
            $brojeviNiz = array_map('intval', explode(',', $red['listaBrojeva']));
            foreach($brojeviNiz as $br) {
                $ukupnoBrojeva = $ukupnoBrojeva + $br;
            }
        }

        $idAktiviste = $red['idAktiviste'];
        $upit = "SELECT * FROM flajerisanje.adrese 
        WHERE idAktiviste = '$idAktiviste' AND flajerisano = 1";
        $rezAdrese = $veza->query($upit);
        $brojIsflajerisanih = mysqli_num_rows($rezAdrese);

        echo "<li>
        <div class=\"flex-container\">
            <div class=\"content\">".$red['ime']. " " .$red['prezime']."</div>
            <div class=\"content2\">Podelio/la ".$brojIsflajerisanih." flajera</div>
            <div class=\"content3\">Preostalo ".$ukupnoBrojeva." flajera</div>
        </div>
    </li>"; 
    }

    $veza->close();

 ?>