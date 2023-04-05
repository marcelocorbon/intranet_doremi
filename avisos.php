<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado e é um administrador
if(!isset($_SESSION['area']) || $_SESSION['area'] != 'administrador') {
    header('Location: login.php');
    exit();
}

// Verifica se o formulário foi submetido
if(isset($_POST['titulo']) && isset($_POST['mensagem'])) {
    // Recupera os dados do formulário
    $titulo = $_POST['titulo'];
    $mensagem = $_POST['mensagem'];

    // Insere o aviso no banco de dados
    $sql = 'INSERT INTO avisos (titulo, mensagem) VALUES (:titulo, :mensagem)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':mensagem', $mensagem);

    if($stmt->execute()) {
        echo '<p>Aviso criado com sucesso!</p>';
    } else {
        echo '<p>Ocorreu um erro ao criar o aviso.</p>';
    }
}

// Busca os avisos no banco de dados
$sql = 'SELECT * FROM avisos ORDER BY data_criacao DESC';
$stmt = $pdo->query($sql);
$avisos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos - Minha Empresa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>Minha Empresa</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Produtos</a></li>
                <li><a href="#">Serviços</a></li>
                <?php if($_SESSION['area'] == 'administrador') : ?>
                    <li><a href="avisos.php">Avisos</a></li>
                    <li><a href="#">Funções exclusivas</a></li>
                <?php endif; ?>
                <li><a href="#">Contato</a></li>
            </ul>
            <form action="logout.php" method="post">
                <input type="submit" value="Sair">
            </form>
        </nav>
    </header>
    <main>
        <h2>Avisos</h2>
        <form action="avisos.php" method="post">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" required></textarea>
            <input type="submit" value="Criar Aviso">
        </form>
        <section>
            <?php foreach($avisos as $aviso) : ?>
                <article>
                    <h3><?php echo $aviso['titulo']; ?></h3>
                    <p><?php echo $aviso['mensagem']; ?></p>
                    <p class="data"><?php echo date('d/m/Y H:i', strtotime($aviso['data_criacao'])); ?></p>
                </article>
            <?php endforeach; ?>
        </section>
