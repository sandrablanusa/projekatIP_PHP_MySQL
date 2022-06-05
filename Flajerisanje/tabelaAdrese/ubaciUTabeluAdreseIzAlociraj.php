<?php
    session_start();
    if (isset($_POST['Alociraj'])) {

        if(empty($_SESSION['idUlice']) or empty($_SESSION['idFlajera']) or 
           empty($_SESSION['idAktiviste']) or empty($_SESSION['brojFlajera'])) {
            echo '<script>alert("Nisu uneta sva polja, pokušajte opet!");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
        }

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
                $upit = "INSERT INTO flajerisanje.adrese(idUlice, idAktiviste, idFlajera, ulica, brojZgrade) VALUES ('$idUlice', '$idAktiviste', '$idFlajera', '$imeUlice', '$br')";
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
                        listaDatumaDodele = '$listaDatuma' WHERE idAktiviste = '$idAktiviste'";
            $rez = $veza->query($upit);
            if ($rez != 1) {
                $greska = true;
            }           

            // Ubacivanje u tabelu ulica

            $stariBrojevi = $redUlica['nedodeljeniBrojevi'];
            $stariBrojeviNiz = array_map('intval', explode(',', $stariBrojevi));

            $preostaliBrojevi = "";

            foreach($stariBrojeviNiz as $br1) {
                $postoji = false;

                foreach($brojeviZgrada as $br2) {
                    if($br1 == $br2) {
                        $postoji = true;
                    }
                }

                if(!$postoji) {
                    if($preostaliBrojevi == "") {
                        $preostaliBrojevi = $br1;
                    } else {
                        $preostaliBrojevi = $preostaliBrojevi.", ".$br1;
                    }
                }
            }

            $upit = "UPDATE flajerisanje.ulica SET 
                        idFlajera = '$idFlajera',
                        nedodeljeniBrojevi = '$preostaliBrojevi' WHERE idUlice = '$idUlice'";
            $rez = $veza->query($upit);
            if ($rez != 1) {
                $greska = true;
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

