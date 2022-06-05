<?php 

    $veza=mysqli_connect("localhost", "root", "", "Flajerisanje");

    $sql = <<<EOT
    CREATE TABLE zahtevi (
        idZahteva INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
        idUlice INT ,
        brojeviZgrada VARCHAR(255) CHARACTER SET utf8,
        idFlajera INT ,
        idAktiviste INT ,
        brojFlajera INT)
    EOT;
    
    mysqli_select_db($veza,'Flajerisanje');
    mysqli_query($veza,$sql);
    mysqli_close($veza);
?>