<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/Database.php';
require_once '../classes/Receita.php';

$db = (new Database())->connect();
$receita = new Receita($db);

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];

    if ($receita->inserir($descricao, $valor, $data)) {
        $mensagem = "Receita inserida com sucesso!";
    } else {
        $mensagem = "Erro ao inserir receita.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Incluir Receita</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Incluir Receita</h2>
        <?php if ($mensagem): ?>
            <p><?= $mensagem ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="descricao" placeholder="Descrição" required>
            <input type="number" step="0.01" name="valor" placeholder="Valor" required>
            <input type="date" name="data" required>
            <button type="submit">Salvar</button>
        </form>
        <a href="dashboard.php">← Voltar ao Dashboard</a>
    </div>
</body>
</html>
