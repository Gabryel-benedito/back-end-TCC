<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

$busca = $_GET['busca'] ?? '';

$sql = "
    SELECT
        id, descricao_do_alimento, energia_kcal
    FROM alimentos
    WHERE descricao_do_alimento LIKE :busca OR Categoria LIKE :busca
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":busca", "%$busca%");
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
