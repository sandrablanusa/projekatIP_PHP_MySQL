<?php 

    $veza=mysqli_connect("localhost", "root", "", "Flajerisanje");

    $sql = <<<EOT
    CREATE TABLE ulica (
        idUlice INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        ulica VARCHAR(100) CHARACTER SET utf8 NOT NULL,
        idFlajera INT NOT NULL,
        brojevi VARCHAR(200) CHARACTER SET utf8 NOT NULL,
        nedodeljeniBrojevi VARCHAR(200) CHARACTER SET utf8 NOT NULL)
    EOT;
    
    mysqli_select_db($veza,'Flajerisanje');
    mysqli_query($veza,$sql);
    mysqli_close($veza);
?>