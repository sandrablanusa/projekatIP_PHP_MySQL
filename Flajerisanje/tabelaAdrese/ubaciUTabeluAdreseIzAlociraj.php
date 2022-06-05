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

        $upitAktivista = "SELECT * FROM flajerisanje.aktivisti WHERE idAktiviste = '$idAktiviste'";
        $rezAktivista = $veza->query($upitAktivista);
    
        if(mysqli_num_rows($rezUlica) != 0 and mysqli_num_rows($rezAktivista) != 0) {
            $greska = false;

            // Ubacivanje u tabelu adrese
            $redUlica = mysqli_fetch_array($rezUlica);
            $imeUlice = $redUlica['ulica'];

            foreach($brojeviZgrada as $br) {
                $upit = "INSERT INTO flajerisanje.adrese(idUlice, idAktiviste, idFlajera, brFlajera, ulica, brojZgrade) VALUES ('$idUlice', '$idAktiviste', '$idFlajera', '$brFlajera', '$imeUlice', '$br')";
                $rez = $veza->query($upit);
                if ($rez != 1) {
                    $greska = true;
                }
            }

            // Ubacivanje u tabelu aktivisti
            $redAkt = mysqli_fetch_array($rezAktivista);
            if(is_null($redAkt['listaIDFlajera']) or is_null($redAkt['listaBrojeva']) or is_null($redAkt['listaDatumaDodele'])) {
                $listaFlajera = $idFlajera;
                $listaBrojeva = $brFlajera;
                $listaDatuma = date("m.d.Y.");
            } else {
                $listaFlajera = $redAkt['listaIDFlajera'].", ".$idFlajera;
                $listaBrojeva = $redAkt['listaBrojeva'].", ".$brFlajera;
                $listaDatuma = $redAkt['listaDatumaDodele'].", ".date("m.d.Y.");
            }

            $upit = "UPDATE flajerisanje.aktivisti SET 
                        listaIDFlajera = '$listaFlajera',
                        listaBrojeva = '$listaBrojeva',
                        listaDatuma = '$listaDatuma' WHERE idAktiviste = $idAktiviste";
            $rez = $veza->query($upit);
            if ($rez != 1) {
                $greska = true;
            }           


            if (!$greska) {
                echo '<script>alert("Uspešno alociranje podataka");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
            } else {
            //    echo '<script>alert("Desila se greška, pokušajte opet!");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
            }

        } else {
            //echo '<script>alert("Desila se greška, pokušajte opet!");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
        }

        $veza->close();
    }

    session_destroy();
?>
