<?php

if (empty($_POST["name"])) {
    die("É obrigatório inserir seu nome!");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Insira um email válido!");
}

if (strlen($_POST["password"]) < 8) {
    die("A senha deve ter no mínimo 8 caracteres");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("A senha deve ter no mínimo uma letra.");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("A senha deve ter no mínimo um número.");
}

if ($_POST["password"] !== $_POST["confpassword"]) {
    die("As senhas devem ser iguais.");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("Erro no SQL: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: sucessocadastro.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Esse email já está em uso.");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}