<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.potencijalniAktivisti";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);
        
        echo "                <li>
        <div class=\"flex-container\">
            <div class=\"content\">".$red['ime']. " " .$red['prezime']."</div>
            <div class=\"dugmiciKontejner\">
                <div class=\"odobriAktivistu\">
                    <div class=\"button\">
                        <button name=\"odobri\" type=\"submit\" value=\"".$red['idAktiviste']."\">Odobri</button>
                    </div>
                </div>
                <div class=\"delete\">
                    <div class=\"button\">
                        <button name=\"odbij\" type=\"submit\" value=\"".$red['idAktiviste']."\">Odbij</button>
                    </div>
                </div>
            </div>
        </div>
    </li>";      
    }

    $veza->close();
 ?>

 