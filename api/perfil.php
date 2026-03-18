<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

$usuario_id = $_GET['id'] ?? null;

$sql = "
    SELECT   email,
    nome,
    data_nascimento,
    sexo
    FROM usuarios
    WHERE id = :id
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $usuario_id);
$stmt->execute();

echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
