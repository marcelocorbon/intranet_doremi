<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Verifica se os campos foram preenchidos
if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['area'])) {
	
	// Recupera os dados do formulário
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$area = $_POST['area'];

	// Insere os dados do usuário no banco de dados
	$sql = 'INSERT INTO usuarios (nome, email, senha, area) VALUES (:nome, :email, :senha, :area)';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':nome', $nome);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':senha', $senha);
	$stmt->bindParam(':area', $area);
	
	// Executa a consulta
	if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
        header('Location: inicio.php');
    } else {
        echo "Erro ao cadastrar o usuário: " . $stmt->errorInfo()[2];
        header('Location: cadastro.php');
    }
    
	
	// Fecha a conexão com o banco de dados
	$pdo = null;
}

    // HTML da tela de cadastro
?>
    
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_cadastro.css">
	<title>Cadastro de Usuário</title>
</head>
<body>
	<h1>Cadastro de Usuário</h1>
	<form action="cadastro.php" method="post">
		<label for="nome">Nome:</label>
		<input type="text" id="nome" name="nome" required>
		<br>
		<label for="email">E-mail:</label>
		<input type="email" id="email" name="email" required>
		<br>
		<label for="senha">Senha:</label>
		<input type="password" id="senha" name="senha" required>
		<br>
		<label for="area">Área:</label>
		<select id="area" name="area">
			<option value="Vendedor">Vendas</option>
			<option value="administrador">Administração</option>
		</select>
		<br>
		<input type="submit" value="Cadastrar">
	</form>
</body>
</html>

