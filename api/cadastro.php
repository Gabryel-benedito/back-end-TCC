
<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

$dados = json_decode(file_get_contents("php://input"), true);

$nome  = trim($dados["nome"] ?? null);
$email = trim($dados["email"] ?? null);
$senha = $dados["senha"] ?? null;
$data_nascimento = $dados['data_nascimento'];
$peso_kg         = $dados['peso_kg'];
$altura_cm       = $dados['altura_cm'];
$sexo            = $dados['sexo'];
$nivel_atividade = $dados['nivel_atividade'];
$meta = $dados['meta'];



if (!$nome || !$email || !$senha) {
    echo json_encode([
        "success" => false,
        "message" => "Dados obrigatórios não enviados"
    ]);
    exit;
}

// verifica se email já existe
$sql = "SELECT id FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":email", $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo json_encode([
        "success" => false,
        "message" => "E-mail já cadastrado"
    ]);
    exit;
}

// cria usuário
$hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "
    INSERT INTO usuarios (nome, email, senha, data_nascimento, peso_kg, altura_cm, sexo, nivel_atividade, meta)
    VALUES (:nome, :email, :senha, :data_nascimento, :peso_kg, :altura_cm, :sexo, :nivel_atividade, :meta)
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":nome", $nome);
$stmt->bindValue(":email", $email);
$stmt->bindValue(":senha", $hash);
$stmt->bindValue(":data_nascimento", $data_nascimento);
$stmt->bindValue(":peso_kg", $peso_kg);
$stmt->bindValue(":altura_cm", $altura_cm);
$stmt->bindValue(":sexo", $sexo);
$stmt->bindValue(":nivel_atividade", $nivel_atividade);
$stmt->bindValue(":meta", $meta);

$stmt->execute();

echo json_encode([
    "success" => true,
    "usuario" => [
        "id" => $pdo->lastInsertId(),
        "nome" => $nome,
        "email" => $email,
        "sexo" => $sexo,
        "nivel_atividade" => $nivel_atividade,
        "meta" => $meta
    ]
]);

