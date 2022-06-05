<?php
session_start();

if(isset($_POST["unesi"])){
    $idFlajera = $_SESSION["idFlajeraAzuriraj"];
    $stariBrFlajera = $_SESSION["brFlajeraAzuriraj"];
    $idAktiviste = $_SESSION['idLogovanogAktiviste'];
    
    $noviBrFlajera = $_POST["broj"];

    if(((int)$noviBrFlajera) > ((int)$stariBrFlajera)) {
        echo '<script>alert("Broj flajera nije ispravan!");window.location.href=("flajeri.html")</script>';
    }

    $greska = false;

    $razlikaFlajera = ((int)$stariBrFlajera) - ((int)$noviBrFlajera);

    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");

    // Azuriranje tabele aktivisti
    $upit = "SELECT * FROM flajerisanje.aktivisti WHERE idAktiviste = '$idAktiviste'";

    $rez = $veza->query($upit);
    $red = mysqli_fetch_array($rez);
    
    $nizIdFlajera = array_map('intval', explode(',', $red['listaIDFlajera']));
    $nizBrojeva = array_map('intval', explode(',', $red['listaBrojeva']));
    $nizDatuma = array_map('intval', explode(',', $red['listaDatumaDodele']));

    $duzinaNiza = count($nizIdFlajera);

    for ($i=0; $i<$duzinaNiza; $i++){
        
        $ovajFlajerId =$nizIdFlajera[$i];

        if($ovajFlajerId == $idFlajera) {
            $nizBrojeva[$i] = $noviBrFlajera;
        }
    }
    
    $nizBrojevaString = "";
    $nizIdFlajeraString = "";
    $datumiString = "";

    for ($i=0; $i<$duzinaNiza; $i++){
        if($nizBrojeva[$i] != 0) {
            if($nizBrojevaString == "") {
                $nizBrojevaString = $nizBrojeva[$i];
                $nizIdFlajeraString = $nizIdFlajera[$i];
                $datumiString = $nizDatuma[$i];
            } else {
                $nizBrojevaString = $nizBrojevaString.", ".$nizBrojeva[$i];
                $nizIdFlajeraString = $nizIdFlajeraString.", ".$nizIdFlajera[$i];
                $datumiString = $datumiString.", ".$nizDatuma[$i];
            }
        }
    }

    $upit = "UPDATE flajerisanje.aktivisti 
    SET listaIdFlajera = '$nizIdFlajeraString', listaBrojeva = '$nizBrojevaString', listaDatumaDodele = '$datumiString'
    WHERE idAktiviste = '$idAktiviste'";

    $rez = $veza->query($upit);
    if($rez != 1) $greska = true;

    // Azuriranje tabele flajeri
    $upit = "SELECT * FROM flajerisanje.flajeri WHERE idFlajera = '$idFlajera'";

    $rez = $veza->query($upit);
    $red = mysqli_fetch_array($rez);

    $ukupanBrojPreostalihFlajera = $red['brojPreostalihFlajera'] - $razlikaFlajera;

    $upit = "UPDATE flajerisanje.flajeri 
    SET brojPreostalihFlajera = '$ukupanBrojPreostalihFlajera'
    WHERE idFlajera = '$idFlajera'";
    $rez = $veza->query($upit);
    if($rez != 1) $greska = true;

    if($greska) {
        echo '<script>alert("Desila se greška, pokušajte opet!");window.location.href=("flajeri.html")</script>';
    } else {
        echo '<script>alert("Uspešno ažuriranje broja flajera!");window.location.href=("flajeri.html")</script>';
    }
    
    $veza->close();
}

?>