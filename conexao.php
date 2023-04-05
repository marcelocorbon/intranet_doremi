<?php
// Configurações de conexão com o banco de dados 
$dsn = 'mysql:host=localhost;dbname=doremi_intranet';
$username = 'root';
$password = '';

// Cria uma nova conexão com o banco de dados
try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
}
?>
