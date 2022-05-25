<?php
    $veza = new mysqli("localhost", "root", "");

    $opcije = ['cost' => 10];
    $sifrovanaLozinka = password_hash('admin123', PASSWORD_DEFAULT, $opcije);
    $upit = "INSERT INTO flajerisanje.administrator(email, sifra) VALUES ('admin@flajeri.com', '$sifrovanaLozinka' )";
    $rez = $veza->query($upit);

    $veza->close();

 ?>