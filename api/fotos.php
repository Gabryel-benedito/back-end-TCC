<?php
header("Content-Type: application/json");
require_once "config/conexao.php";

if (isset($_FILES['foto'])) {

    $arquivo = $_FILES['foto'];
    $usuario_id = $_POST['id'] ?? null;

    if (!$usuario_id) {
        echo json_encode(["status" => "erro", "msg" => "ID não enviado"]);
        exit;
    }

    $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
    $permitidos = ['jpg', 'jpeg', 'png'];

    if (!in_array(strtolower($extensao), $permitidos)) {
        echo json_encode(["status" => "tipo_invalido"]);
        exit;
    }

    $caminho = "uploads/" . uniqid() . "." . $extensao;

    if (move_uploaded_file($arquivo['tmp_name'], $caminho)) {

        $usuario_id = intval($usuario_id);

        $sql = "UPDATE usuarios SET foto = :caminho WHERE id = :usuario_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":caminho", $caminho, PDO::PARAM_STR);
        $stmt->bindValue(":usuario_id", $usuario_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "ok",
                "foto" => $caminho
            ]);
        } else {
            echo json_encode(["status" => "erro_db"]);
        }
    } else {
        echo json_encode(["status" => "erro_upload"]);
    }
} else {
    echo json_encode(["status" => "sem_arquivo"]);
}
