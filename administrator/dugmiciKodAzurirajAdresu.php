<?php
    if(isset($_POST["obrisi"])){
        $idUlice=$_POST["obrisi"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
    
        $upit = "DELETE FROM flajerisanje.ulica WHERE idUlice = '$idUlice' ";
    
        $rez = $veza->query($upit);
    
        $veza->close();
    }

    if(isset($_POST["azuriraj"])){
        $idUlice=$_POST["azuriraj"];
        $_SESSION["idUlice"] = $idUlice;
        echo '<script>window.location.href=("unesiAdresu.html")</script>';
        exit();
    }
 ?>