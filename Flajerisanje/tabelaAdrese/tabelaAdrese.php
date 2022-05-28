<?php 

    $veza=mysqli_connect("localhost", "root", "", "Flajerisanje");

    $sql = <<<EOT
    CREATE TABLE adrese (
        idAdrese INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
        idUlice INT NOT NULL,
        brojZgrade INT NOT NULL,
        idFlajera INT NOT NULL,
        idAktiviste INT NOT NULL,
        flajerisano BOOLEAN NOT NULL,
        ulica VARCHAR(100) CHARACTER SET utf8 NOT NULL,
        datumKraj VARCHAR(50) CHARACTER SET utf8 NOT NULL)
    EOT;
    
    mysqli_select_db($veza,'Flajerisanje');
    mysqli_query($veza,$sql);
    mysqli_close($veza);
?>