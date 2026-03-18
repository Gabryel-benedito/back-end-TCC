<?php

$host = "localhost";
$banco = "yourdiet";
$usuario = "root";
$senha = "";


try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["erro" => "Falha na conexão"]);
    exit;
}

?>