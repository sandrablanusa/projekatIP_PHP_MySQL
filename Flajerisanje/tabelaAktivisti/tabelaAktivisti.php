<?php 

$veza=mysqli_connect("localhost", "root", "");
$sql="DROP DATABASE IF EXISTS Flajerisanje";
mysqli_query($veza,$sql);

$sql="CREATE DATABASE IF NOT EXISTS Flajerisanje DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
mysqli_query($veza,$sql);
$sql = <<<EOT
CREATE TABLE aktivisti (
idAktiviste INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
ime VARCHAR(50) CHARACTER SET utf8 NOT NULL,
prezime VARCHAR(50) CHARACTER SET utf8 NOT NULL,
adresa VARCHAR(125) CHARACTER SET utf8 NOT NULL,
telefon VARCHAR(20) CHARACTER SET utf8 NOT NULL,
email VARCHAR(100) CHARACTER SET utf8 NOT NULL,
sifra VARCHAR(100) CHARACTER SET utf8 NOT NULL,
listaIDFlajera VARCHAR(255) CHARACTER SET utf8 ,
listaBrojeva VARCHAR(255) CHARACTER SET utf8 ,
listaDatumaDodele VARCHAR(255) CHARACTER SET utf8)
EOT;
mysqli_select_db($veza,'Flajerisanje');
mysqli_query($veza,$sql);
mysqli_close($veza);
?>