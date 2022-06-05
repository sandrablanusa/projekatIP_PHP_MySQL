<?php 

$veza=mysqli_connect("localhost", "root", "");

$sql = <<<EOT
CREATE TABLE potencijalniAktivisti (
idAktiviste INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
ime VARCHAR(50) CHARACTER SET utf8 NOT NULL,
prezime VARCHAR(50) CHARACTER SET utf8 NOT NULL,
adresa VARCHAR(125) CHARACTER SET utf8 NOT NULL,
telefon VARCHAR(20) CHARACTER SET utf8 NOT NULL,
email VARCHAR(100) CHARACTER SET utf8 NOT NULL,
sifra VARCHAR(100) CHARACTER SET utf8 NOT NULL)
EOT;
mysqli_select_db($veza,'Flajerisanje');
mysqli_query($veza,$sql);
mysqli_close($veza);
?>