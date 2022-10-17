<?php

$host = "127.0.0.1";
$dbname = "login_db";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

return $mysqli;