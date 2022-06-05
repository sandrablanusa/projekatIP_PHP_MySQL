<?php
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    $idAktiviste = $_SESSION['idLogovanogAktiviste'];
    $upit = "SELECT * FROM flajerisanje.aktivisti WHERE idAktiviste = '$idAktiviste'";

    $rez = $veza->query($upit);
    $red = mysqli_fetch_array($rez);
    
    if(!is_null($red['listaIDFlajera']) and !is_null($red['listaBrojeva'])){

        $nizIdFlajera = array_map('intval', explode(',', $red['listaIDFlajera']));
        $nizBrojeva = array_map('intval', explode(',', $red['listaBrojeva']));

        $duzinaNiza = count($nizIdFlajera);

        for ($i=0; $i<$duzinaNiza; $i++){
            
            $brFlajera =$nizBrojeva[$i];
            $idFlajera =$nizIdFlajera[$i];

            $upit = "SELECT * FROM flajerisanje.flajeri WHERE idFlajera = '$idFlajera'";
            $rez = $veza->query($upit);
            $red = mysqli_fetch_array($rez);

            echo "                <li>
            <div class=\"flex-container\">
                <div class=\"content\"><a href=\"../Flajerisanje/tabelaFlajeri/".$red['HTMLFajl']."\">".$red['naziv']."</a></div>
                <div class=\"content\">Preostalo flajera: ".$brFlajera."</div>
                <div class=\"dugmiciKontejner\">
                    <div class=\"delete\">
                        <div class=\"button\">
                            <button name=\"azuriraj\" type=\"submit\" value=\"".$idFlajera.",".$brFlajera."\">Unesi broj flajera</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>";
            
        }
    }

    $veza->close();

 ?>