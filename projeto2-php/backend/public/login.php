<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173"); // Ajuste o domínio conforme necessário
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true"); // Permite enviar cookies de sessão
header("Content-Type: application/json");

require "../app/database.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['senha'])) {
    echo json_encode(["status" => "error", "message" => "Campos obrigatórios!"]);
    exit;
}

$sql = "SELECT id, email, senha FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $data['email']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($data['senha'], $user['senha'])) {
    $_SESSION['user_id'] = $user['id']; // Cria a sessão com o ID do usuário
    echo json_encode(["status" => "success", "message" => "Login realizado com sucesso!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Usuário ou senha incorretos!"]);
}
?>
