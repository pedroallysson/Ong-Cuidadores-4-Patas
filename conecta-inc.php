<?php

$servername = "mysql-pedroallysson.alwaysdata.net";
$username = "290314";
$password = "Credi@2022";
$dbname = "pedroallysson_2022";

$conn = new mysqli($servername, $username, $password, $dbname);

//O trecho abaixo verifica se existem erros, compatível com PHP >= 5.3
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error); //encerra o script por completo
}
//echo "Connected successfully"; //o código daqui em diante só executa se a conexão estiver OK...
?>