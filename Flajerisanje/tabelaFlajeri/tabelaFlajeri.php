<?php 

    $veza=mysqli_connect("localhost", "root", "", "Flajerisanje");

    $sql = <<<EOT
    CREATE TABLE flajeri (
        idFlajera INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        naziv VARCHAR(120) CHARACTER SET utf8 NOT NULL,
        PDFfajl VARCHAR(255) CHARACTER SET utf8,
        HTMLFajl VARCHAR(255) CHARACTER SET utf8 ,
        brojFlajera INT NOT NULL,
        brojPreostalihFlajera INT ,
        brojZgrada VARCHAR(200) CHARACTER SET utf8 ,
        brojPreostalihZgrada VARCHAR(200) CHARACTER SET utf8 ,
        javan BOOLEAN NOT NULL)
    EOT;
    
    mysqli_select_db($veza,'Flajerisanje');
    mysqli_query($veza,$sql);
    mysqli_close($veza);
?>