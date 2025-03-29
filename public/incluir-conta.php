<?php
// incluir-conta.php - Arquivo responsável por funcionalidade específica do sistema
session_start();
$mensagem = $_SESSION['sucesso'] ?? null;
unset($_SESSION['sucesso']);
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once '../config/Database.php';
require_once '../classes/Conta.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
    $tipo = $_POST['tipo'];
    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $db = (new Database())->connect();
    $conta = new Conta($db);
    $dados = [
        'descricao' => $descricao,
        'valor' => $valor,
        'tipo' => $tipo,
        'data' => $data
    ];

    if ($conta->inserir($dados)) {
        $_SESSION['sucesso'] = 'Incluir-conta cadastrada com sucesso!';
    header("Location: incluir-conta.php");
        exit;
    } else {
        $mensagem = "Erro ao inserir a conta.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Incluir Conta</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<div class="container">
    <h2>Incluir Conta</h2>
    <?php if ($mensagem): ?><p style="color:red"><?= $mensagem ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="descricao" placeholder="Descrição" required>
        <input type="number" name="valor" placeholder="Valor" step="0.01" required>
        <select name="tipo" required>
            <option value="pagar">Pagar</option>
            <option value="receber">Receber</option>
        </select>
        <input type="date" name="data" required>
        <button type="submit">Salvar</button>
    </form>
    <a href="dashboard.php">← Voltar</a>
</div>
</body>
</html>
