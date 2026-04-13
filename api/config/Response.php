<?php

class Response
{
    public static function success($dados = [], $mensagem = "OK", $status = 200)
    {
        http_response_code($status);
        echo json_encode([
            "successo" => true,
            "dados" => $dados,
            "menssagem" => $mensagem
        ]);
        exit;
    }

    public static function error($code, $mensagem, $status = 400)
    {
        http_response_code($status);
        echo json_encode([
            "successo" => false,
            "erro" => [
                "code" => $code,
                "menssagem" => $mensagem
            ]
        ]);
        exit;
    }
}
?>