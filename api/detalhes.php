<?php
header("Content-Type: application/json; charset=UTF-8");

require_once "config/conexao.php";
require_once "config/Response.php";

try {
    $id = $_GET['id'] ?? null;

    //VERIFICA SE O ID FOI ENVIADO E SE É NUMÉRICO
    if (!$id || !is_numeric($id)) {
        Response::error(
            "ID_INVALIDO",
            "Parâmetro 'id' é obrigatório e deve ser numérico",
            400
        );
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

    // ALIMENTO NÃO ENCONTRADO
    if (!$resultado) {
        Response::error(
            "ALIMENTO_NAO_ENCONTRADO",
            "Alimento não encontrado",
            404
        );
    }

    // SUCESSO
    Response::success(
        $resultado,
        "Alimento encontrado",
        200
    );

} catch (PDOException $e) {

    Response::error(
        "ERRO_BANCO_DE_DADOS",
        "Erro ao buscar alimento",
        500
    );

} catch (Exception $e) {

    Response::error(
        "ERRO_INTERNO",
        "Erro interno do servidor",
        500
    );
}
?>