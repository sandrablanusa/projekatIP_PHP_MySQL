<?php

    if(isset($_POST["obrisi"])){
        $idAktiviste=$_POST["obrisi"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
    
        $upit = "DELETE FROM flajerisanje.aktivisti WHERE idAktiviste = '$idAktiviste' ";
    
        $rez = $veza->query($upit);
    
        $veza->close();
    }

    if(isset($_POST["azuriraj"])){
        $idAktiviste=$_POST["azuriraj"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");

        $upit = "SELECT * FROM flajerisanje.aktivisti WHERE idAktiviste = '$idAktiviste' ";
        $rez = $veza->query($upit);

        $red = mysqli_fetch_array($rez);

        $_SESSION["aktivistiRed"] = $red;
        echo '<script>window.location.href=("azurirajAktivistuAdmin.html")</script>';
        
        $veza->close();
    }
 ?>