<?php

header("Content-Type: application/json");
require_once "config/conexao.php";



$input = file_get_contents("php://input");
$dados = json_decode($input, true);


file_put_contents("debug.txt", $input . PHP_EOL, FILE_APPEND);
    

if (!$dados) {
    echo json_encode([
        "erro" => "JSON inválido ou vazio"
    ]);
    exit;
}

$usuario_id = $dados['usuario_id'] ?? null;
$meta = $dados['meta'] ?? null;

if ($usuario_id === null || $meta === null) {
    echo json_encode([
        "erro" => "usuario_id e meta são obrigatórios"
    ]);
    exit;
}

/* ===== ATUALIZA BANCO ===== */

try {

    $sql = "UPDATE usuarios SET meta = :meta WHERE id = :usuario_id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":meta", $meta);
    $stmt->bindValue(":usuario_id", $usuario_id, PDO::PARAM_INT);

    $stmt->execute();

    echo json_encode([
        "success" => true,
        "message" => "Meta atualizada com sucesso",
        "meta" => $meta
    ]);

} catch (PDOException $e) {

    echo json_encode([
        "erro" => "Erro ao atualizar meta",
        "detalhes" => $e->getMessage()
    ]);

}

?>