<?php
session_start();
require_once __DIR__ . "/../models/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (User::create($_POST['email'], $_POST['senha'])) {
        header("Location: /templates/tela-login.php");
    } else {
        echo "<script>alert('Erro ao cadastrar!');</script>";
    }
}
?>
