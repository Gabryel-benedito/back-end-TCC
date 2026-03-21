
<?php
header("Content-Type: application/json");
require_once "config/conexao.php";


$dados = json_decode(file_get_contents("php://input"), true);

file_put_contents("debug.txt", json_encode($dados));

if (!$dados) {
    echo json_encode(["erro" => "JSON inválido ou vazio"]);
    exit;
}

$usuario_id = $dados['usuario_id'] ?? null;
$meta = $dados['meta'] ?? null;

if ($usuario_id == null || $meta == null) {
    echo json_encode(["erro" => "usuario_id e meta são obrigatórios"]);
    exit;
}

if (!is_numeric($usuario_id)) {
    echo json_encode(["erro" => "usuario_id deve ser numérp"]);
    exit;
}

try {
    $sql = "UPDATE usuarios SET meta = :meta WHERE id = :usuario_id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(":meta", $meta);
    $stmt->bindValue(":usuario_id", (int)$usuario_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        
        if ($stmt->rowCount() > 0) {
            echo json_encode([
                "success" => true,
                "message" => "Meta atualizada com sucesso",
                "meta" => $meta
            ]);
        } else {
           
            echo json_encode([
                "success" => true, 
                "message" => "Nenhuma alteração realizada (valor igual ao atual ou ID inexistente)"
            ]);
        }
    }
} catch (PDOException $erro) {
    
    echo json_encode([
        "erro" => "Erro no banco de dados: " . $erro->getMessage()
    ]);
} catch (Exception $erro) {
    echo json_encode([
        "erro" => "Erro genérico: " . $erro->getMessage()
    ]);
}
?>