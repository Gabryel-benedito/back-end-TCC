<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

$dados = json_decode(file_get_contents("php://input"), true);
file_put_contents("debug.txt", json_encode($dados));


$email = $dados['email'] ?? '';
$senha = $dados['senha'] ?? '';

if (!$email || !$senha) {
    http_response_code(400);
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "E-mail e senha são obrigatórios"
    ]);
    exit;
}

$sql = "SELECT id, email, senha, nome FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":email", $email);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    http_response_code(401);
    echo json_encode([
        "sucesso" => false,
        "mensagem" => "Credenciais inválidas"
    ]);
    exit;
}

unset($usuario['senha']);

echo json_encode([
    "sucesso" => true,
    "usuario" => $usuario
]);
?>