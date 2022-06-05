<?php

    include('../Flajerisanje/funkcijaAlociraj.php');

    if(isset($_POST["odbij"])){
        $idZahteva=$_POST["odbij"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
    
        $upit = "DELETE FROM flajerisanje.zahtevi WHERE idZahteva = '$idZahteva' ";
    
        $rez = $veza->query($upit);
    
        $veza->close();
    }

    if(isset($_POST["odobri"])){
        $idZahteva=$_POST["odobri"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");

        $upit = "SELECT * FROM flajerisanje.zahtevi WHERE idZahteva = '$idZahteva' ";
        $rez = $veza->query($upit);
        $red = mysqli_fetch_array($rez);

        $idUlice = $red['idUlice'];
        $idAktiviste = $red['idAktiviste'];
        $idFlajera = $red['idFlajera'];
        $brFlajera = $red['brojFlajera'];
        $brojeviZgrada = array_map('intval', explode(',', $red['brojeviZgrada']));

        $greska = alocirajFlajer($idUlice, $idAktiviste, $idFlajera, $brFlajera, $brojeviZgrada);

        $upit = "DELETE FROM flajerisanje.zahtevi WHERE idZahteva = '$idZahteva' ";
        $rez = $veza->query($upit);

        $veza->close();
    }
 ?>