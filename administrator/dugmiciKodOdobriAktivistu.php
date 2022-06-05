<?php

    if(isset($_POST["odbij"])){
        $idAktiviste=$_POST["odbij"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
    
        $upit = "DELETE FROM flajerisanje.potencijalniAktivisti WHERE idAktiviste = '$idAktiviste' ";
    
        $rez = $veza->query($upit);
    
        $veza->close();
    }

    if(isset($_POST["odobri"])){
        $idAktiviste=$_POST["odobri"];

        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
    
        $upit = "SELECT * FROM flajerisanje.potencijalniAktivisti WHERE idAktiviste = '$idAktiviste' ";
    
        $rez = $veza->query($upit);
        $red = mysqli_fetch_array($rez);

        $ime = $red['ime'];
        $prezime = $red['prezime'];
        $adresa = $red['adresa'];
        $telefon = $red['telefon'];
        $email = $red['email'];
        $sifrovanaLozinka = $red['sifra'];

        $upitUnesi = "INSERT INTO flajerisanje.aktivisti(ime, prezime, adresa, telefon, email, sifra) VALUES ('$ime', '$prezime', '$adresa', '$telefon', '$email', '$sifrovanaLozinka' )";
    
        $rezUnesi = $veza->query($upitUnesi);

        $upitIzbrisi = "DELETE FROM flajerisanje.potencijalniAktivisti WHERE idAktiviste = '$idAktiviste' ";
    
        $rezIzbrisi = $veza->query($upitIzbrisi);

        $veza->close();
    }
 ?>