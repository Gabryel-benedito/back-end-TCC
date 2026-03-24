
<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

$dados = json_decode(file_get_contents("php://input"), true);

$nome  = trim($dados["nome"] ?? null);
$email = trim($dados["email"] ?? null); 
$senha = $dados["senha"] ?? null;
$data_nascimento = $dados['data_nascimento'] ?? null;
$sexo            = $dados['sexo'] ?? null;
$meta = 0;



    //verificar se todos os dados foram preenchidos

    if (!$nome || !$email || !$senha || !$data_nascimento || !$sexo) 
        {
        echo json_encode([
            "success" => false,
            "message" => "Dados obrigatórios não enviados"
        ]);
        exit;
    }

    //Validação da data de nascimento do usuario

    try {
        $dataUsuario = new DateTime($data_nascimento);
        $dataAtual = new DateTime();

        if($dataUsuario > $dataAtual){
            echo json_encode([
                "success" => false,
                "message" => "data de nascimento inválida"
            ]);
            exit;
        }
    } catch (Exception $e) {

        echo json_encode([
            "success" => false,
            "message" => "Data inválida"
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
            INSERT INTO usuarios (nome, email, senha, data_nascimento, sexo, meta)
            VALUES (:nome, :email, :senha, :data_nascimento, :sexo, $meta)
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $hash);
        $stmt->bindValue(":data_nascimento", $data_nascimento);
        $stmt->bindValue(":sexo", $sexo);

        $stmt->execute();

        echo json_encode([
            "sucesso" => true,
            "usuario" => [
                "id" => $pdo->lastInsertId(),
                "nome" => $nome,
                "email" => $email,
                "sexo" => $sexo,
                "meta" => $meta
            ]
        ]);

