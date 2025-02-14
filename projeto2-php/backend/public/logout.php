<?php
session_start();
session_destroy(); // Destrói a sessão do usuário
echo json_encode(["status" => "success", "message" => "Logout realizado com sucesso!"]);

header("Access-Control-Allow-Origin: http://localhost:5173"); // Ajuste conforme necessário
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0); // Finaliza a requisição para CORS
}
