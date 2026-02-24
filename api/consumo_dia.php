<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

date_default_timezone_set('America/Sao_Paulo');
$data_hoje = date('Y-m-d');

$usuario_id = $_GET['usuario_id'] ?? null;
$data       = $_GET['data'] ?? $data_hoje;

if (!$usuario_id) {
  http_response_code(400);
  echo json_encode(["erro" => "usuario_id é obrigatório"]);
  exit;
}

$sql = "
  SELECT
    SUM((a.Energia_kcal * cd.quantidade_gramas) / 100)   AS calorias_total,
    SUM((a.Proteina_g * cd.quantidade_gramas) / 100)    AS proteinas_total,
    SUM((a.Carboidrato_g * cd.quantidade_gramas) / 100) AS carboidratos_total,
    SUM((a.Lipidios_totais_g * cd.quantidade_gramas) / 100) AS gorduras_total
  FROM consumo_diario cd
  JOIN alimentos a ON a.id = cd.alimento_id
  WHERE cd.usuario_id = :usuario_id
    AND cd.data_consumo = :data
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":usuario_id", $usuario_id, PDO::PARAM_INT);
$stmt->bindValue(":data", $data);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

// Se não consumiu nada no dia, zera tudo
echo json_encode([
  "data" => $data,
  "calorias"      => round($resultado['calorias_total'] ?? 0, 2),
  "proteinas"     => round($resultado['proteinas_total'] ?? 0, 2),
  "carboidratos"  => round($resultado['carboidratos_total'] ?? 0, 2),
  "gorduras"      => round($resultado['gorduras_total'] ?? 0, 2),
]);
?>