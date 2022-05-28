<?php
if (isset($_POST['unesi'])) {
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");
    $ulica = $_POST['ulica'];

    $postoji = false;
    $provera = $veza->query("SELECT * FROM flajerisanje.ulica WHERE ulica = '$ulica'");

    if (mysqli_num_rows($provera) != 0) {
        $postoji = true;
    }
    if (!$postoji) {
        $upit = "INSERT INTO flajerisanje.ulica(ulica) VALUES ('$ulica' )";
        $rez = $veza->query($upit);

        if ($rez == 1) {
            echo '<script>alert("Uspešno dodavanje ulice!");window.location.href=("../../administrator/unesiUlicu.html")</script>';
        } else {
            echo '<script>alert("Neuspešno dodavanje ulice, pokušajte opet!");window.location.href=("../../administrator/unesiUlicu.html")</script>';
        }
    } else {
        echo '<script>alert("Navedena ulica već postoji!");window.location.href=("../../administrator/unesiUlicu.html")</script>';

    }

    $veza->close();
}
 ?>