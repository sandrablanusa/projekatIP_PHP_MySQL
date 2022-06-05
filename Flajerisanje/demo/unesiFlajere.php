<?php

$veza = new mysqli("localhost", "root", "");
$veza->set_charset("utf8");

$putanja="../../Flajeri/";
$flajeri=array("limarMile", "frizerJovanka", "salonLepotePrinceza", "PecenjaraPetrovic", "perionicaJovan");

$brojac = 1;
$brFlaj = 100;

foreach($flajeri as $flajer) {
    $pdfPutanja = $putanja.$flajer.".pdf";
    $htmlPutanja = $putanja.$flajer.".html";

    for ($x = 0; $x <= 5; $x++) {

        $brojFlajera = $brojac * $brFlaj;

        $imeFlajera = $flajer." ".$x;

        if($brojac % 3 == 0) {
            $javan = 0;
        } else {
            $javan = 1;
        }   

        $upit = "INSERT INTO flajerisanje.flajeri(naziv, brojFlajera, brojPreostalihFlajera, javan, PDFfajl, HTMLFajl)
                 VALUES ('$imeFlajera', '$brojFlajera', '$brojFlajera', '$javan', '$pdfPutanja', '$htmlPutanja')";
        $rez = $veza->query($upit);

        $brojac = $brojac + 1;

    }
}

$veza->close();

?>