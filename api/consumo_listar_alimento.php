<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

date_default_timezone_set('America/Sao_Paulo');

$usuario_id = $_GET['usuario_id'] ?? null;
$data       = $_GET['data'] ?? date('Y-m-d');

if (!$usuario_id) {
  http_response_code(400);
  echo json_encode(["erro" => "usuario_id é obrigatório"]);
  exit;
}

$sql = "
  SELECT

    a.id AS alimento_id,
    cd.id AS consumo_id,
    cd.data_consumo,
    cd.quantidade_gramas,

    
    a.descricao_do_alimento,

    -- valores reais consumidos
    ROUND((CAST(a.Energia_kcal AS DECIMAL(10,2)) * cd.quantidade_gramas) / 100, 2) AS kcal_consumidas,

    ROUND((CAST(a.Proteina_g AS DECIMAL(10,2)) * cd.quantidade_gramas) / 100, 2) AS proteina_consumida,

    ROUND((CAST(a.Carboidrato_g AS DECIMAL(10,2)) * cd.quantidade_gramas) / 100, 2) AS carboidrato_consumido,
    
    ROUND((CAST(a.Lipidios_totais_g AS DECIMAL(10,2)) * cd.quantidade_gramas) / 100, 2) AS gordura_consumida

  FROM consumo_diario cd
  JOIN alimentos a ON a.id = cd.alimento_id
  WHERE cd.usuario_id = :usuario_id
    AND cd.data_consumo = :data
  ORDER BY cd.criado_em DESC
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":usuario_id", $usuario_id, PDO::PARAM_INT);
$stmt->bindValue(":data", $data);
$stmt->execute();

$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

/**
 * Totais do dia (agregação)
 */
$totais = [
  "kcal" => 0,
  "proteina" => 0,
  "carboidrato" => 0,
  "gordura" => 0
];

foreach ($dados as $item) {
  $totais["kcal"]        += $item["kcal_consumidas"];
  $totais["proteina"]    += $item["proteina_consumida"];
  $totais["carboidrato"] += $item["carboidrato_consumido"];
  $totais["gordura"]     += $item["gordura_consumida"];
}

echo json_encode([
  "data" => $data,
  "usuario_id" => $usuario_id,
  "totais_do_dia" => [
    "kcal" => round($totais["kcal"], 2),
    "proteina" => round($totais["proteina"], 2),
    "carboidrato" => round($totais["carboidrato"], 2),
    "gordura" => round($totais["gordura"], 2)
  ],
  "itens" => $dados
]);
?>