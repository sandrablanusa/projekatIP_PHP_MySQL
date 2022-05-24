<?php
    $veza = new mysqli("localhost", "root", "");
    $upit = "INSERT INTO flajerisanje.administrator(email, sifra) VALUES ('admin@flajeri.com', 'admin123' )";
    $rez = $veza->query($upit);

    $veza->close();

 ?>