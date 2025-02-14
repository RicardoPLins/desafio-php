<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Se o usuário já estiver logado, redireciona para o main
    header("Location: /public/main.php");
    exit;
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

require "../app/database.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email']) || !isset($data['senha'])) {
    echo json_encode(["status" => "error", "message" => "Campos obrigatórios!"]);
    exit;
}

$email = $data['email'];
$senha = password_hash($data['senha'], PASSWORD_DEFAULT); // Criptografando a senha

// Verifica se o email já existe
$sql = "SELECT id FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(["status" => "error", "message" => "Email já registrado!"]);
    exit;
}

// Insere o novo usuário no banco de dados
$sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email, 'senha' => $senha]);

// Cria a sessão para o novo usuário
$_SESSION['user_id'] = $pdo->lastInsertId();

echo json_encode(["status" => "success", "message" => "Cadastro realizado com sucesso!"]);
