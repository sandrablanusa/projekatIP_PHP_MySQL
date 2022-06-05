<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $upit = "SELECT * FROM flajerisanje.flajeri";

    $rez = $veza->query($upit);
    $brojRedova = mysqli_num_rows($rez);

    for ($i=0; $i<$brojRedova; $i++){
        $red = mysqli_fetch_array($rez);
        $zgrade = is_null($red['brojPreostalihZgrada']) ? "" : $red['brojPreostalihZgrada'];
        $brFlajera = is_null($red['brojPreostalihFlajera']) ? "" : $red['brojPreostalihFlajera'];
        echo "                <li>
        <div class=\"flex-container\">
            <div class=\"content\"><a href=\"../Flajerisanje/tabelaFlajeri/".$red['HTMLFajl']."\">".$red['naziv']."</a></div>
            <div class=\"content\">Preostalo zgrada: ".$zgrade."</div>
            <div class=\"content\">Preostalo flajera: ".$brFlajera."</div>
            <div class=\"dugmiciKontejner\">
                <div class=\"azurirajAdresu\">
                    <div class=\"button\">
                        <button name=\"azuriraj\" type=\"submit\" value=\"".$red['idFlajera']."\">Ažuriraj</button>
                    </div>
                </div>
                <div class=\"delete\">
                    <div class=\"button\">
                        <button name=\"alociraj\" type=\"submit\" value=\"".$red['idFlajera']."\">Alociraj</button>
                    </div>
                </div>
            </div>
        </div>
    </li>";
        
    }

    $veza->close();

 ?>