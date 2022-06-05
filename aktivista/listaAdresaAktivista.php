<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $idAktiviste = $_SESSION['idLogovanogAktiviste'];
    $upit = "SELECT * FROM flajerisanje.adrese WHERE idAktiviste = '$idAktiviste'";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);
        $flajerisano = $red['flajerisano'];
    
        if(is_null($flajerisano) or $flajerisano == false) {

            $idAdrese = $red['idAdrese'];

            $idUlice = $red['idUlice'];
            $brojZgrade = $red['brojZgrade'];
            $idFlajera = $red['idFlajera'];

            
            $upitUlica = "SELECT * FROM flajerisanje.ulica WHERE idUlice = '$idUlice'";
            $rezUlica = $veza->query($upitUlica);
            $redUlica = mysqli_fetch_array($rezUlica);
            $imeUlice = $redUlica['ulica'];

            $upitFlajer = "SELECT * FROM flajerisanje.flajeri WHERE idFlajera = '$idFlajera'";
            $rezFlajer = $veza->query($upitFlajer);
            $redFlajer= mysqli_fetch_array($rezFlajer);
            $imeFlajera = $redFlajer['naziv'];

            echo "                <li>
            <div class=\"flex-container\">
                <div class=\"content\">Adresa: ".$imeUlice." ".$brojZgrade."</div>
                <div class=\"content\">Flajer: ".$imeFlajera."</div>
                <div class=\"dugmiciKontejner\">
                    <div class=\"delete\">
                        <div class=\"button\">
                            <button name=\"flajerisano\" type=\"submit\" value=\"".$red['idAdrese']."\">Flajerisano</button>
                        </div>
                    </div>
                    <div class=\"delete\">
                        <div class=\"button\">
                            <button name=\"obrisi\" type=\"submit\" value=\"".$red['idAdrese']."\">Obriši</button>
                        </div>
                    </div>
                </div>
            </div>
            </li>";
        }   
    }

    $veza->close();

 ?>