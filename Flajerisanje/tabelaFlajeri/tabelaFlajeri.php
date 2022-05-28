<?php 

    $veza=mysqli_connect("localhost", "root", "", "Flajerisanje");

    $sql = <<<EOT
    CREATE TABLE flajeri (
        idFlajera INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        naziv VARCHAR(100) CHARACTER SET utf8 NOT NULL,
        HTMLFajl VARCHAR(255) CHARACTER SET utf8 NOT NULL,
        brojFlajera INT NOT NULL,
        brojPreostalihFlajera INT NOT NULL,
        brojZgrada VARCHAR(200) CHARACTER SET utf8 NOT NULL,
        brojPreostalihZgrada VARCHAR(200) CHARACTER SET utf8 NOT NULL,
        javan BOOLEAN NOT NULL)
    EOT;
    
    mysqli_select_db($veza,'Flajerisanje');
    mysqli_query($veza,$sql);
    mysqli_close($veza);
?>