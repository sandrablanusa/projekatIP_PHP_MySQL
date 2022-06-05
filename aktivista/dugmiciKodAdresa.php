<?php
    if(isset($_POST["flajerisano"])){
        $idAdrese = $_POST["flajerisano"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");

        // Azuriranje tabele adresa
        $datumKraja = date("m.d.Y.");
        $upit = "UPDATE flajerisanje.adrese
        SET flajerisano = true, datumKraj = '$datumKraja'
        WHERE idAdrese = '$idAdrese' ";
        $rez = $veza->query($upit);
        
        // Azuriranje tabele flajeri
        $upit = "SELECT * FROM flajerisanje.adrese WHERE idAdrese = '$idAdrese' ";
        $rez = $veza->query($upit);
        $red = mysqli_fetch_array($rez);
        $idFlajera = $red['idFlajera'];

        $upit = "SELECT * FROM flajerisanje.flajeri WHERE idFlajera = '$idFlajera' ";
        $rez = $veza->query($upit);
        $red = mysqli_fetch_array($rez);
        if($red['brojPreostalihZgrada'] == 0) $brojPreostalihZgrada = 0;
        else $brojPreostalihZgrada = $red['brojPreostalihZgrada'] - 1;

        $upit = "UPDATE flajerisanje.flajeri
        SET brojPreostalihZgrada = '$brojPreostalihZgrada'
        WHERE idFlajera = '$idFlajera' ";
        $rez = $veza->query($upit);

        $veza->close();
    }

    if(isset($_POST["obrisi"])){
        $idAdrese = $_POST["obrisi"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
    
        $upit = "DELETE FROM flajerisanje.adrese WHERE idAdrese = '$idAdrese' ";
    
        $rez = $veza->query($upit);
    
        $veza->close();
    }
 ?>