<?php
session_start();
session_unset(); // Limpa as variáveis de sessão
session_destroy(); // Destroi a sessão

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

echo json_encode(["status" => "success", "message" => "Logout realizado com sucesso"]);
exit;
?>
