<?php 
    session_start();

    if (isset($_POST['prijava'])) {
        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
        $email = $_POST['email'];
        $sifra = $_POST['sifra'];

        if ($email == "admin@flajeri.rs" and $sifra == "admin123") {
            header("location:../administrator/navAdministrator.html");
        } else {
            $provera = $veza->query("SELECT * FROM flajerisanje.aktivisti WHERE email = '$email'");
            $row = mysqli_fetch_array($provera);
            $sifraHash = $row['sifra'];

            if (password_verify($sifra, $sifraHash)) {
                header("location:../aktivista/navAktivista.html");
            } else {
                echo '<script>alert("Podaci nisu ispravni, pokušajte opet!");window.location.href=("pocetnaNavigacijaUlogujSe.html")</script>';
            }
        }


    }

?>