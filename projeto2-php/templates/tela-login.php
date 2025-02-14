<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- carrega o link do bootstrap5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container w-25 bg-white shadow p-4 rounded">
        <h2 class="text-center mb-4">Login</h2>

        <!-- Verificação se o login está correto -->
        <?php if (isset($_SESSION['erro_login'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['erro_login']; ?>
            </div>
            <?php unset($_SESSION['erro_login']); ?>  <!-- Limpa a mensagem de erro após exibi-la -->
        <?php endif; ?>

        <!-- Forms de login  -->
        <form action="/app/controllers/login.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Senha:</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
        <p class="text-center mt-3">Não tem uma conta? <a href="tela-register.html">Cadastre-se</a></p>
    </div>
</body>
</html>
