

<?php
header("Content-Type: application/json; charset=UTF-8");

require_once "config/conexao.php";
require_once "config/Response.php";

try {
    $busca = $_GET['busca'] ?? '';


    if (empty(trim($busca))) {
        Response::error(
            "BUSCA_SEM_PARAMETRO",
            "Parâmetro 'busca' é obrigatório",
            400
        );
    }

    $sql = "
       SELECT
        id, descricao_do_alimento, energia_kcal
        FROM alimentos
        WHERE descricao_do_alimento LIKE :busca OR Categoria LIKE :busca
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":busca", "%$busca%");
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // PESQUISA SEM ALIMENTO ENCONTRADO
    if (!$resultados) {
        Response::error(
            "ALIMENTO_NAO_ENCONTRADO",
            "Nenhum alimento encontrado",
            404
        );
    }

    // MENSSAGEM DE SUCESSO DE BUSCA DE ALIMENTOS
    Response::success(
        $resultados,
        "Alimentos encontrados",
        200
    );
} catch (PDOException $e) {

    // ERRO DO BANCO DE DADOS
    Response::error(
        "DATABASE_ERROR",
        "Erro ao buscar dados",
        500
    );
} catch (Exception $e) {

    // ALGUM OUTRO ERRO
    Response::error(
        "ERRO_INTERNO",
        "Erro interno do servidor",
        500
    );
}
