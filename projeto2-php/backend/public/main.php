<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173"); // Ajuste o domínio conforme necessário
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // Permite enviar cookies de sessão
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Usuário não autenticado."]);
    exit;
}

// Se o usuário estiver autenticado, busque os dados necessários
require "../app/database.php";

$sql = "SELECT id, email FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(["status" => "success", "data" => $user]);
