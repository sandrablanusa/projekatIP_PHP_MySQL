<?php
if (isset($_POST['registrujSe'])) {
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $sifra = $_POST['sifra'];
    $listaIDFlajera = NULL;
    $listaBrojeva = NULL;
    $listaDatumaDodele = NULL;

    $opcije = ['cost' => 10];
    $sifrovanaLozinka = password_hash($sifra, PASSWORD_DEFAULT, $opcije);

    //ukoliko nije dobar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Proverite email adresu i pokušajte opet!");window.location.href=("../../pocetnaNavigacija/pocetnaNavigacijaRegistrujSe.html")</script>';
    } else {
        $postoji = false;

        $provera = $veza->query("SELECT * FROM flajerisanje.aktivisti WHERE email = '$email'");

        if (mysqli_num_rows($provera) != 0) {
            $postoji = true;
        }

        if (!$postoji) {
            $upit = "INSERT INTO flajerisanje.aktivisti(ime, prezime, adresa, telefon, email, sifra, listaIDFlajera, listaBrojeva, listaDatumaDodele) VALUES ('$ime', '$prezime', '$adresa', '$telefon', '$email', '$sifrovanaLozinka', '$listaIDFlajera', '$listaBrojeva', '$listaDatumaDodele' )";
            $rez = $veza->query($upit);

            if ($rez == 1) {
                echo '<script>alert("Uspešna registracija");window.location.href=("../../pocetnaNavigacija/pocetnaNavigacijaUlogujSe.html")</script>';
            } else {
                echo '<script>alert("Neuspešna registracija, pokušajte opet!");window.location.href=("../../pocetnaNavigacija/pocetnaNavigacijaRegistrujSe.html")</script>';
            }
        } else {
            echo '<script>alert("Email adresa već postoji!");window.location.href=("../../pocetnaNavigacija/pocetnaNavigacijaRegistrujSe.html")</script>';
        }
    }

    $veza->close();
}
