<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Minha Página</title>
	<link rel="stylesheet" href="style_inicio.css">
</head>
<body>
	<header>
		<div class="logo">
			<h1>Dorémi Brinquedos</h1>
		</div>
		<nav>
			<ul>
				<li><a href="inicio.php">Home</a></li>
				<li><a href="#">Avisos</a></li>
				<li><a href="#">Atividades</a></li>
				<?php
					// Verifica se o usuário é administrador e exibe o botão de funções exclusivas
					if (isset($_SESSION['area']) && $_SESSION['area'] == 'administrador') {
						echo '<li class="dropdown">';
						echo '<a href="#" class="dropbtn">Funções Exclusivas</a>';
						echo '</li>';
					}
				?>
				<li><a href="#">Contatos</a></li>
                <li><a href="#">Financeiro</a></li>
                <li><a href="logout.php">Sair</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section>
			<h2>Olá, colaborador Dorémi! Como vai?</h2>
			<p>Onde a Diversão Acontece! A empresa DoRéMi foi fundada em 1994 e tem como atividade principal 
                o comércio varejista de brinquedos e artigos recreativos, possui uma rede de lojas.</p>
		</section>
	</main>
	<footer>
		<p>&copy; 2023 - Todos os direitos reservados</p>
	</footer>
</body>
</html>
