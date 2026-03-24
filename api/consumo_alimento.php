<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

$dados = json_decode(file_get_contents("php://input"), true);

// valida JSON
if (!$dados) {
  http_response_code(400);
  echo json_encode(["erro" => "JSON inválido"]);
  exit;
}

$camposObrigatorios = [
  'usuario_id',
  'alimento_id',
  'data_consumo',
  'quantidade_gramas',
];

foreach ($camposObrigatorios as $campo) {
  if (!isset($dados[$campo]) || $dados[$campo] === '') {
    http_response_code(400);
    echo json_encode(["erro" => "Campo obrigatório ausente: $campo"]);
    exit;
  }
}

$usuario_id        = (int) $dados['usuario_id'];
$alimento_id       = (int) $dados['alimento_id'];
$data_consumo      = $dados['data_consumo'];
$quantidade_gramas = (float) $dados['quantidade_gramas'];


if ($quantidade_gramas <= 0) {
  http_response_code(400);
  echo json_encode(["erro" => "Quantidade inválida"]);
  exit;
}

$sql = "
  INSERT INTO consumo_diario (
    usuario_id,
    alimento_id,
    data_consumo,
    quantidade_gramas
  ) VALUES (
    :usuario_id,
    :alimento_id,
    :data_consumo,
    :quantidade_gramas
  )
";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(":usuario_id", $usuario_id, PDO::PARAM_INT);
$stmt->bindValue(":alimento_id", $alimento_id, PDO::PARAM_INT);
$stmt->bindValue(":data_consumo", $data_consumo);
$stmt->bindValue(":quantidade_gramas", $quantidade_gramas);

$stmt->execute();

echo json_encode([
  "sucesso" => true,
  "mensagem" => "Consumo registrado com sucesso"
]);
?>