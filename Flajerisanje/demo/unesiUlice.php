<?php

$veza = new mysqli("localhost", "root", "");
$veza->set_charset("utf8");

$ulice=array("Molerova", "Balkanska", "Krunska", "Školska", "Prvomajska", "Glavna", "Sarajevska", "Petra Kočića", "Bulevar Oslobođenja",
             "Dunavska", "Ruzveltova", "Kraljice Marije", "Cvijićeva", "Beogradska", "Starine Novaka", "Resavska", "Stevana Sremca");
$brojevi="1,2,3,4,5,6,7,8,9,10";


foreach($ulice as $ul) {
    $upit = "INSERT INTO flajerisanje.ulica(ulica, brojevi, nedodeljeniBrojevi) VALUES ('$ul', '$brojevi', '$brojevi')";
    $rez = $veza->query($upit);
}

$veza->close();

?>