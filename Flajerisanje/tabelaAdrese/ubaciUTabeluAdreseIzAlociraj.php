<?php
    session_start();
    if (isset($_POST['Alociraj'])) {
        $veza = new mysqli("localhost", "root", "");
        $veza->set_charset("utf8");
        $idUlice = $_SESSION['idUlice'];
        $idAktiviste = $_SESSION['idAktiviste'];
        $idFlajera = $_SESSION['idFlajera'];
        $brFlajera = $_SESSION['brojFlajera'];
        $brojeviZgrada = $_POST['brojeviZgrada'];

        $upitUlica = "SELECT * FROM flajerisanje.ulica WHERE idUlice = '$idUlice'";
        $rezUlica = $veza->query($upitUlica);
    
        if(mysqli_num_rows($rezUlica) != 0) {
            $red = mysqli_fetch_array($rezUlica);
            $imeUlice = $red['ulica'];

            $greska = false;
            foreach($brojeviZgrada as $br) {
                $upit = "INSERT INTO flajerisanje.adrese(idUlice, idAktiviste, idFlajera, brFlajera, ulica, brojZgrade) VALUES ('$idUlice', '$idAktiviste', '$idFlajera', '$brFlajera', '$imeUlice', '$br')";
                $rez = $veza->query($upit);
                if ($rez != 1) {
                    $greska = true;
                }
            }

            if (!$greska) {
                echo '<script>alert("Uspešno alociranje podataka");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
            } else {
                echo '<script>alert("Desila se greška, pokušajte opet!");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
            }

        } else {
            echo '<script>alert("Desila se greška, pokušajte opet!");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
        }

        $veza->close();
    }

    session_destroy();
?>
