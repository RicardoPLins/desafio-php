<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: /templates/tela-login.php"); // Redireciona para a página de login, se o usuário não estiver logado
    exit();
}

// Recupera o email do usuário armazenado na sessão
$user_email = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand">Modelo 2 - Ricardo Lins</a>
            <a href="/app/controllers/logout.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container text-center mt-5">
        <h1>Seja Bem-vindo!</h1>
        <h2>Usuário de email: <?php echo htmlspecialchars($user_email); ?></h2>
        <p class="lead">Esse é o modelo 2!</p>
    </div>
</body>
</html>
