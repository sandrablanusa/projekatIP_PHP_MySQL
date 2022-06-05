<?php 

    $veza=mysqli_connect("localhost", "root", "", "Flajerisanje");

    $sql = <<<EOT
    CREATE TABLE adrese (
        idAdrese INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
        idUlice INT ,
        brojZgrade INT ,
        idFlajera INT ,
        idAktiviste INT ,
        flajerisano BOOLEAN ,
        brFlajera INT,
        ulica VARCHAR(100) CHARACTER SET utf8 ,
        datumKraj VARCHAR(50) CHARACTER SET utf8 )
    EOT;
    
    mysqli_select_db($veza,'Flajerisanje');
    mysqli_query($veza,$sql);
    mysqli_close($veza);
?>