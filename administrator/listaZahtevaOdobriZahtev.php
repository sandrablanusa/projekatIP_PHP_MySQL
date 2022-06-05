<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.zahtevi";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);
        
        $idAktiviste = $red['idAktiviste'];
        $upitAkt = "SELECT * FROM flajerisanje.aktivisti WHERE idAktiviste = '$idAktiviste' ";
        $rezAkt = $veza->query($upitAkt);
        $redAkt = mysqli_fetch_array($rezAkt);

        $idFlajera = $red['idFlajera'];
        $upitFl = "SELECT * FROM flajerisanje.flajeri WHERE idFlajera = '$idFlajera' ";
        $rezFl = $veza->query($upitFl);
        $redFl = mysqli_fetch_array($rezFl);

        $idUlice = $red['idUlice'];
        $upitUl = "SELECT * FROM flajerisanje.ulica WHERE idUlice = '$idUlice' ";
        $rezUl = $veza->query($upitUl);
        $redUl = mysqli_fetch_array($rezUl);

        echo "
        <li>
        <div class=\"flex-container\">
            <div class=\"content\">Ime: ".$redAkt['ime']." ".$redAkt['prezime']."</div>
            <div class=\"content\">Flajer: ".$redFl['naziv']."</div>
            <div class=\"content\">Broj flajera: ".$red['brojFlajera']."</div>
            <div class=\"content\">Ulica: ".$redUl['ulica']."</div>
            <div class=\"dugmiciKontejner\">
                <div class=\"odobriZahtev\">
                    <div class=\"button\">
                    <button name=\"odobri\" type=\"submit\" value=\"".$red['idZahteva']."\">Odobri</button>
                    </div>
                </div>
                <div class=\"delete\">
                    <div class=\"button\">
                    <button name=\"odbij\" type=\"submit\" value=\"".$red['idZahteva']."\">Odbij</button>
                    </div>
                </div>
            </div>
        </div>
    </li>
    ";      
    }

    $veza->close();
 ?>

 