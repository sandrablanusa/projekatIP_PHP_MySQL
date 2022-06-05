<?php
    if(isset($_POST["flajerisano"])){
        $idAdrese = $_POST["flajerisano"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");

        $upit = "UPDATE flajerisanje.adrese
        SET flajerisano = true
        WHERE idAdrese = '$idAdrese' ";
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