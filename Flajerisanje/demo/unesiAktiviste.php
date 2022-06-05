<?php

$veza = new mysqli("localhost", "root", "");
$veza->set_charset("utf8");

$imena=array("Milica","Ana","Jovana","Bojana","Sara","Marko","Janko","Stefan","Nikola","Nemanja");
$prezimena=array("Milic","Jovanovic", "Stankovic", "Aleksic","Bogdanovic", "Ilic");

$brojac = 0;

foreach($imena as $ime) {
    foreach($prezimena as $prezime) {
        $brojac = $brojac + 1;

        $email = strtolower($ime).".".strtolower($prezime)."@gmail.com";
        $sifra = strtolower($ime).".".strtolower($prezime);

        $opcije = ['cost' => 10];
        $sifrovanaLozinka = password_hash($sifra, PASSWORD_DEFAULT, $opcije);

        $telefon = "011223344";
        $adresa = "Bulevar kralja Aleksandra 73";

        if($brojac % 4) {
            $upit = "INSERT INTO flajerisanje.aktivisti(ime, prezime, adresa, telefon, email, sifra) VALUES ('$ime', '$prezime', '$adresa', '$telefon', '$email', '$sifrovanaLozinka')";
            $rez = $veza->query($upit);
        } else {
            $upit = "INSERT INTO flajerisanje.potencijalniAktivisti(ime, prezime, adresa, telefon, email, sifra) VALUES ('$ime', '$prezime', '$adresa', '$telefon', '$email', '$sifrovanaLozinka')";
            $rez = $veza->query($upit);
        }
    }
}

$veza->close();

?>