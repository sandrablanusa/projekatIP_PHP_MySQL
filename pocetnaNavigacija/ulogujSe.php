<?php 
    session_start();

    if (isset($_POST['prijava'])) {
        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
        $email = $_POST['email'];
        $sifra = $_POST['sifra'];

        $proveraAdmin = $veza->query("SELECT * FROM flajerisanje.administrator WHERE email = '$email'");
       
        if (mysqli_num_rows($proveraAdmin) != 0) {

            $rowAdmin = mysqli_fetch_array($proveraAdmin);
            $sifraHashAdmin = $rowAdmin['sifra'];

            if (password_verify($sifra, $sifraHashAdmin)) {
                header("location:../administrator/navAdministrator.html");
            } else {
                echo '<script>alert("Podaci nisu ispravni, pokušajte opet!");window.location.href=("pocetnaNavigacijaUlogujSe.html")</script>';
            }

        } else {
            $provera = $veza->query("SELECT * FROM flajerisanje.aktivisti WHERE email = '$email'");
            if (mysqli_num_rows($provera) != 0) {
                $row = mysqli_fetch_array($provera);
                $sifraHash = $row['sifra'];

                if (password_verify($sifra, $sifraHash)) {
                    $_SESSION['idLogovanogAktiviste'] = $row['idAktiviste'];
                    header("location:../aktivista/navAktivista.html");
                } else {
                echo '<script>alert("Podaci nisu ispravni, pokušajte opet!");window.location.href=("pocetnaNavigacijaUlogujSe.html")</script>';
                }
            } else {
                echo '<script>alert("Podaci nisu ispravni, pokušajte opet!");window.location.href=("pocetnaNavigacijaUlogujSe.html")</script>';

            }
        }


    }

?>