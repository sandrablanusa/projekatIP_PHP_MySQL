<?php
session_start();
$target_dir = "../../sacuvaniFajlovi/";

$_SESSION["pdfFile"] = basename($_FILES["pdfDugme"]["name"]);
$_SESSION["htmlFile"] = basename($_FILES["htmlDugme"]["name"]);

if (isset($_POST['sacuvaj'])) {
    $veza = new mysqli("localhost", "root", "");
    $veza->set_charset("utf8");
    $naziv = $_POST['naziv'];
    $brojFlajera = 0;
    if(!empty($_POST['brojFlajera'])) $brojFlajera = $_POST['brojFlajera'];

    $pdf_file = "";
    if($_FILES["pdfDugme"]["name"] != "") {
        $pdf_file = $target_dir . basename($_FILES["pdfDugme"]["name"]);
    }

    $html_file = "";
    if($_FILES["htmlDugme"]["name"] != "") {
        $html_file = $target_dir . basename($_FILES["htmlDugme"]["name"]);
    }

    $pdfFileType = strtolower(pathinfo($pdf_file,PATHINFO_EXTENSION));
    $htmlFileType = strtolower(pathinfo($html_file,PATHINFO_EXTENSION));

    $odgovor = $_POST['privat'];
    if($odgovor == "javan") {
        $javan = 1;
    }
    if($odgovor == "tajan") {
        $javan = 0;
    }

    // Check file size
    if ($_FILES["pdfDugme"]["size"] > 1048576 or $_FILES["htmlDugme"]["size"] > 1048576) {
        echo '<script>alert("Fajl je prevelik!");window.location.href=("../../administrator/unesiFlajerAdmin.html")</script>';
    } else {

        if(($pdf_file != "" and $pdfFileType != "pdf") or ($html_file != "" and $htmlFileType != "htm" and $htmlFileType != "html" )) {
            echo '<script>alert("Format fajla nije odgovarajući!");window.location.href=("../../administrator/unesiFlajerAdmin.html")</script>';
        } else {
            $rez1 = 1; $rez2 = 1;

            if($pdf_file != "") {
                $rez1 = move_uploaded_file($_FILES["pdfDugme"]["tmp_name"], $pdf_file);
            }
            if($html_file != "") {
                $rez2 = move_uploaded_file($_FILES["htmlDugme"]["tmp_name"], $html_file);
            }

            if($rez1 == 1 && $rez2 == 1) {

                $upit = "INSERT INTO flajerisanje.flajeri(naziv, brojFlajera, brojPreostalihFlajera, javan, PDFfajl, HTMLFajl) VALUES ('$naziv', '$brojFlajera', '$brojFlajera', '$javan', '$pdf_file', '$html_file')";
                $rez = $veza->query($upit);

                if ($rez == 1) {
                    echo '<script>alert("Uspešno dodavanje flajera!");window.location.href=("../../administrator/unesiFlajerAdmin.html")</script>';
                } else {
                    echo '<script>alert("Neuspešno dodavanje flajera, pokušajte opet!");window.location.href=("../../administrator/unesiFlajerAdmin.html")</script>';
                }

            } else {
                echo '<script>alert("Neuspešno dodavanje fajlova, pokušajte opet!");window.location.href=("../../administrator/unesiFlajerAdmin.html")</script>';
            }

        }
    }

    $veza->close();
}

session_destroy();
 ?>