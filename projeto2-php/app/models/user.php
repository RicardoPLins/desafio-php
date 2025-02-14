<?php
require_once __DIR__ . "/../../config/database.php";

class User {
    public static function create($email, $senha) {
        global $pdo;
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute(['email' => $email, 'senha' => $senha_hash]);
    }

    public static function findByEmail($email) {
        global $pdo;
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
