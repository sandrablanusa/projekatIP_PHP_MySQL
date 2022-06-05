<?php
    if(isset($_POST["azuriraj"])){
        $idBrFlajera = $_POST["azuriraj"];
        $nizIdBr = array_map('intval', explode(',', $idBrFlajera));

        $idFlajera=$nizIdBr[0];
        $brFlajera=$nizIdBr[1];
        
        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");

        $upit = "SELECT * FROM flajerisanje.flajeri WHERE idFlajera = '$idFlajera' ";
        $rez = $veza->query($upit);

        $red = mysqli_fetch_array($rez);

        $_SESSION["idFlajeraAzuriraj"] = $idFlajera;
        $_SESSION["imeFlajeraAzuriraj"] = $red['naziv'];
        $_SESSION["brFlajeraAzuriraj"] = $brFlajera;
        echo '<script>window.location.href=("brojFlajeraa.html")</script>';
        
        $veza->close();
    }
 ?>