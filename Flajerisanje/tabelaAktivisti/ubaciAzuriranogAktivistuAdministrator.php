<?php
session_start();

if (isset($_POST['unesi'])) {
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $adresa = $_POST['adresa'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $sifrovanaLozinka = "";
    if(!empty($_POST['sifra'])) {
        $sifra = $_POST['sifra'];
        $opcije = ['cost' => 10];
        $sifrovanaLozinka = password_hash($sifra, PASSWORD_DEFAULT, $opcije);
    }
    $idAktiviste = $_SESSION["aktivistiRed"]['idAktiviste'];

    //ukoliko nije dobar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Proverite email adresu i pokušajte opet!");window.location.href=("../../administrator/azurirajAktivistu.html")</script>';
    } else {

        if($sifrovanaLozinka == "") {
            $upit = "UPDATE flajerisanje.aktivisti SET
                        ime = '$ime', prezime = '$prezime',
                        adresa = '$adresa', telefon = '$telefon',
                        email = '$email'
                    WHERE idAktiviste = '$idAktiviste'";
        } else {
            $upit = "UPDATE flajerisanje.aktivisti SET
                        ime = '$ime', prezime = '$prezime',
                        adresa = '$adresa', telefon = '$telefon',
                        email = '$email', sifra = '$sifrovanaLozinka'
                    WHERE idAktiviste = '$idAktiviste'";
        }
        $rez = $veza->query($upit);

        if ($rez == 1) {
            echo '<script>alert("Uspešno ažuriranje aktiviste");window.location.href=("../../administrator/azurirajAktivistu.html")</script>';
        } else {
            echo '<script>alert("Nije uspelo ažuriranje aktiviste, pokušajte opet!");window.location.href=("../../administrator/azurirajAktivistu.html")</script>';
        }
    }

    $veza->close();
}

session_destroy();

?>