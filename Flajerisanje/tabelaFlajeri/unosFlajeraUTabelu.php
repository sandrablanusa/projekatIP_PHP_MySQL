<?php
if (isset($_POST['sacuvaj'])) {
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");
    $naziv = $_POST['naziv'];
    $brojFlajera = $_POST['brojFlajera'];

    $odgovor = $_POST['privat'];
    if($odgovor == "javan") {
        $javan = TRUE;
    } else {
        $javan = FALSE;
    }


    $upit = "INSERT INTO flajerisanje.flajeri(naziv, brojFlajera, javan) VALUES ('$naziv', '$brojFlajera', '$javan')";
    $rez = $veza->query($upit);

    if ($rez == 1) {
        echo '<script>alert("Uspešno dodavanje flajera!");window.location.href=("../../administrator/unesiFlajerAdmin.html")</script>';
    } else {
        echo '<script>alert("Neuspešno dodavanje flajera, pokušajte opet!");window.location.href=("../../administrator/unesiFlajerAdmin.html")</script>';
    }


    $veza->close();
}
 ?>