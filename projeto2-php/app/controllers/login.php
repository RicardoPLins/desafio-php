<?php
session_start();
require_once __DIR__ . "/../models/User.php"; // Ajuste conforme necessário

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procura o usuário pelo e-mail
    $user = User::findByEmail($_POST['email']);

    // Se o usuário for encontrado e a senha for válida
    if ($user && password_verify($_POST['senha'], $user['senha'])) {
        // Cria a sessão com o email do usuário
        $_SESSION['usuario'] = $user['email'];
        // Redireciona para a página principal
        header("Location: ../../index.php");
        exit;
    } else {
        // Caso o login falhe, exibe a mensagem de erro
        $_SESSION['erro_login'] = 'Usuário ou senha incorretos!';
        // Redireciona de volta para a página de login
        header("Location: /templates/tela-login.php");
        exit;
    }
}
?>
