<?php 

    $veza=mysqli_connect("localhost", "root", "", "Flajerisanje");

    $sql = <<<EOT
    CREATE TABLE ulica (
        idUlice INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        ulica VARCHAR(100) CHARACTER SET utf8 NOT NULL,
        idFlajera INT,
        brojevi VARCHAR(200) CHARACTER SET utf8,
        nedodeljeniBrojevi VARCHAR(200) CHARACTER SET utf8)
    EOT;
    
    mysqli_select_db($veza,'Flajerisanje');
    mysqli_query($veza,$sql);
    mysqli_close($veza);
?>