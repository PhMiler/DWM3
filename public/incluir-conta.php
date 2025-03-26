<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/Database.php';
require_once '../classes/Conta.php';

$db = (new Database())->connect();
$conta = new Conta($db);

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];

    if ($conta->inserir($descricao, $valor, $tipo, $data)) {
        $mensagem = "Conta inserida com sucesso!";
    } else {
        $mensagem = "Erro ao inserir conta.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Incluir Conta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Incluir Conta</h2>
        <?php if ($mensagem): ?>
            <p><?= $mensagem ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="descricao" placeholder="Descrição" required>
            <input type="number" step="0.001" name="valor" placeholder="Valor" required>
            <select name="tipo" required>
                <option value="">Tipo</option>
                <option value="pagar">Pagar</option>
                <option value="receber">Receber</option>
            </select>
            <input type="date" name="data" required>
            <button type="submit">Salvar</button>
        </form>
        <a href="dashboard.php">← Voltar ao Dashboard</a>
    </div>
</body>
</html>
