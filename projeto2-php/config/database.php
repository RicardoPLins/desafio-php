<?php
$host = "localhost";
$port = "5432";
$dbname = "ricardo";
$user = "postgres";
$password = "password";

#Irá configurar o banco de acordo com os dados acima
try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Erro ao conectar ao PostgreSQL: " . $e->getMessage());
}
?>
