<?php
header("Access-Control-Allow-Origin: *"); // Permite conexões de qualquer origem
header("Content-Type: application/json");

require "../app/database.php"; // Ajuste o caminho conforme necessário

$response = ["status" => "error", "message" => "Nenhuma ação definida."];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT id, email FROM usuarios";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $response = ["status" => "success", "data" => $users];
}

echo json_encode($response);
