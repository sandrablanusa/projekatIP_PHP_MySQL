<?php

    if(isset($_POST["alociraj"])){
        $idFlajera=$_POST["alociraj"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");

        $upit = "SELECT * FROM flajerisanje.flajeri WHERE idFlajera = '$idFlajera' ";
        $rez = $veza->query($upit);

        $red = mysqli_fetch_array($rez);

        $_SESSION['alocirajFlajer'] = true;
        $_SESSION['idFlajera'] = $red['idFlajera'];
        echo '<script>window.location.href=("alocirajFlajerAdmin.html")</script>';
        
        $veza->close();
    }

    if(isset($_POST["azuriraj"])){
        $idFlajera=$_POST["azuriraj"];
        
        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");

        $upit = "SELECT * FROM flajerisanje.flajeri WHERE idFlajera = '$idFlajera' ";
        $rez = $veza->query($upit);

        $red = mysqli_fetch_array($rez);

        $_SESSION["flajerRed"] = $red;
        echo '<script>window.location.href=("azurirajFlajerAdmin.html")</script>';
        
        $veza->close();
    }
 ?>