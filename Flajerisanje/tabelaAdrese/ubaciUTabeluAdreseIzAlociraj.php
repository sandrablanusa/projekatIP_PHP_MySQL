<?php
    session_start();

    include('../funkcijaAlociraj.php');

    if (isset($_POST['Alociraj'])) {

        if(empty($_SESSION['idUlice']) or empty($_SESSION['idFlajera']) or 
           empty($_SESSION['idAktiviste']) or empty($_SESSION['brojFlajera'])) {
            echo '<script>alert("Nisu uneta sva polja, pokušajte opet!");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
        }

        $idUlice = $_SESSION['idUlice'];
        $idAktiviste = $_SESSION['idAktiviste'];
        $idFlajera = $_SESSION['idFlajera'];
        $brFlajera = $_SESSION['brojFlajera'];
        $brojeviZgrada = $_POST['brojeviZgrada'];

        $greska = alocirajFlajer($idUlice, $idAktiviste, $idFlajera, $brFlajera, $brojeviZgrada);

        if (!$greska) {
            echo '<script>alert("Uspešno alociranje podataka");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
        } else {
            echo '<script>alert("Desila se greška, pokušajte opet!");window.location.href=("../../administrator/alocirajAdmin.html")</script>';
        }
    }

    session_destroy();
?>

