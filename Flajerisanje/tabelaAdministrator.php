<?php 

    $veza=mysqli_connect("localhost", "root", "", "Flajerisanje");

    $sql = <<<EOT
    CREATE TABLE administrator (
        email VARCHAR(100) CHARACTER SET utf8 NOT NULL,
        sifra VARCHAR(100) CHARACTER SET utf8 NOT NULL)
    EOT;
    mysqli_select_db($veza,'Flajerisanje');
    mysqli_query($veza,$sql);
    
    mysqli_close($veza);
?>