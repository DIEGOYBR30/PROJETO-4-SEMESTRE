<?php

$host = "127.0.0.1"; //nome ou ip do computador onde está o banco
$usuario   = "root"; //root é o usuário padrao do mysql
$senha    = ""; // senha do banco de dados
$database   = "trabalhologin"; // nome do banco de dados

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}
?>