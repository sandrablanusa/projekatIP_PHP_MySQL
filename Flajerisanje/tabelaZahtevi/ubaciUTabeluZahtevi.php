<?php
    session_start();
    if (isset($_POST['Unesi'])) {

        if(empty($_SESSION['idUlice']) or empty($_SESSION['idFlajera']) or empty($_SESSION['brojFlajera'])) {
            echo '<script>alert("Nisu uneta sva polja, pokušajte opet!");window.location.href=("../../aktivista/unesiZahtev.html")</script>';
        }

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
        $idUlice = $_SESSION['idUlice'];
        $idAktiviste = $_SESSION['idLogovanogAktiviste'];
        $idFlajera = $_SESSION['idFlajera'];
        $brFlajera = $_SESSION['brojFlajera'];

        $brojeviZgrada = "";
        foreach($_POST['brojeviZgrada'] as $br) {
            if($brojeviZgrada == "") $brojeviZgrada = $br;
            else $brojeviZgrada = $brojeviZgrada.", ".$br;
        }

        $greska = false;

        $upit = "INSERT INTO flajerisanje.zahtevi(idUlice, brojeviZgrada, idFlajera, idAktiviste, brojFlajera) 
                 VALUES ('$idUlice', '$brojeviZgrada', '$idFlajera', '$idAktiviste', '$brFlajera')";
        $rez = $veza->query($upit);

        if ($rez == 1) {
            echo '<script>alert("Uspešno podnesen zahtev");window.location.href=("../../aktivista/unesiZahtev.html")</script>';
        } else {
            echo '<script>alert("Desila se greška, pokušajte opet!");window.location.href=("../../aktivista/unesiZahtev.html")</script>';
        }

       $veza->close();

    }

    $tmpAktivista = $_SESSION['idLogovanogAktiviste'];
    session_destroy();
    session_start();
    $_SESSION['idLogovanogAktiviste'] = $tmpAktivista;
?>

