<?php
header("Content-Type: application/json; charset=UTF-8");
require_once "config/conexao.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(["erro" => "ID não informado"]);
    exit;
}

$sql = "
    SELECT *
    FROM alimentos
    WHERE id = :id
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
    echo json_encode(["erro" => "Alimento não encontrado"]);
    exit;
}

echo json_encode($resultado);
