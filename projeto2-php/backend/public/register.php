<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Cabeçalhos permitidos
header("Access-Control-Allow-Credentials: true"); // Permitir cookies e credenciais

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require "../app/database.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Método inválido"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (empty($data['email']) || empty($data['senha'])) {
    echo json_encode(["status" => "error", "message" => "Campos obrigatórios!"]);
    exit;
}

$email = $data['email'];

$sql = "SELECT id FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(["status" => "error", "message" => "Email já registrado!"]);
    exit;
}

$senhaCriptografada = password_hash($data['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email, 'senha' => $senhaCriptografada]);

$user_id = $pdo->lastInsertId();

$_SESSION['user_id'] = $user_id; // Cria a sessão do usuário após o cadastro

echo json_encode(["status" => "success", "message" => "Cadastro realizado com sucesso!"]);
?>
