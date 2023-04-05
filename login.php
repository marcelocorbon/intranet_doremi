<?php
// Inicia a sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Verifica se os campos foram preenchidos
if(isset($_POST['email']) && isset($_POST['senha'])) {
    // Recupera os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta o banco de dados para verificar se o usuário existe
    $sql = 'SELECT * FROM usuarios WHERE email = :email AND senha = :senha';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();
    $usuario = $stmt->fetch();

    if($usuario) {
        // Cria a sessão do usuário
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['area'] = $usuario['area'];

        // Redireciona o usuário para a página de início
        header('Location: inicio.php');
    } else {
        echo "E-mail ou senha inválidos";
    }

    // Fecha a conexão com o banco de dados
    $pdo = null;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
	<title>Login de Usuário</title>
</head>
<body>
	<h1>Login de Usuário</h1>
	<form action="login.php" method="post">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <br>
        <input type="submit" value="Entrar">
    </form>
    <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se aqui</a>.</p>
</body>
</html>
