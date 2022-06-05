<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.flajeri";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);
        //echo "<li><div class=\"content\">".$red['naziv']."</div></li>";
        echo "                <li>
        <div class=\"flex-container\">
            <div class=\"content\">".$red['naziv']."</div>
            <div class=\"dugmiciKontejner\">
                <div class=\"azurirajFlajer\">
                    <div class=\"button\">
                        <button name=\"azuriraj\" type=\"submit\" value=\"".$red['idFlajera']."\">Ažuriraj</button>
                    </div>
                </div>
                <div class=\"delete\">
                    <div class=\"button\">
                        <button name=\"obrisi\" type=\"submit\" value=\"".$red['idFlajera']."\">Obriši</button>
                    </div>
                </div>
            </div>
        </div>
    </li>";
        
    }

    $veza->close();

 ?>

 