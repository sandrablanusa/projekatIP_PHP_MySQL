<?php

if (isset($_POST['unesiAdresu'])) {
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");
    
    if (!isset($_POST['adresa'])) {
       echo '<script>alert("Morate izabrati adresu.");window.location.href=("../../administrator/unesiAdresu.html")</script>';

    } else {
        $brojevi = $_POST['brojevi'];
        $brojeviInt = array_map('intval', explode(',', $brojevi));
        $adresa = $_POST['adresa'];

        $upit1 = "SELECT * FROM flajerisanje.ulica WHERE ulica = '$adresa' ";
        $rez1 = $veza->query($upit1);

        $red = mysqli_fetch_array($rez1);
        $stariBrojevi = $red['brojevi'];
        $stariBrojeviInt = array_map('intval', explode(',', $stariBrojevi));

        $noviBrojevi = $stariBrojevi;

        foreach($brojeviInt as $noviBr) {

            $postoji = False;

            foreach($stariBrojeviInt as $stariBr) {
                if($stariBr == $noviBr) {
                    $postoji = True;
                }
            }

            if(!$postoji) {
                $noviBrojevi = $noviBrojevi . ", " . $noviBr;
            }

        }

        $upit2 = "UPDATE flajerisanje.ulica SET brojevi = '$noviBrojevi' WHERE ulica = '$adresa' ";
        $rez2 = $veza->query($upit2);

        if ($rez2 == 1) {
            echo '<script>alert("Uspešno dodavanje adrese!");window.location.href=("../../administrator/unesiAdresu.html")</script>';
        } else {
            echo '<script>alert("Neuspešno dodavanje adrese, pokušajte opet!");window.location.href=("../../administrator/unesiAdresu.html")</script>';
        }
    }

    $veza->close();

}
 ?>