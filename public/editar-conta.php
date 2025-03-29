<?php
$mes = $_GET['mes'] ?? date('Y-m');
// editar-conta.php - Arquivo responsável por funcionalidade específica do sistema
session_start();
if (!isset($_SESSION['usuario_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit;
}

require_once '../config/Database.php';
require_once '../classes/Conta.php';

$db = (new Database())->connect();
$conta = new Conta($db);
$id = $_GET['id'];
$registro = $conta->buscarPorId($id);
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = [
        'descricao' => filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS),
        'valor' => filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT),
        'tipo' => $_POST['tipo'],
        'data' => filter_input(INPUT_POST, 'data', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
    ];

    if ($conta->editar($id, $dados)) {
        header("Location: relatorio.php?mes=$mes");
        exit;
    } else {
        $mensagem = "Erro ao atualizar a conta.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Conta</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<div class="container">
    <h2>Editar Conta</h2>
    <?php
$mes = $_GET['mes'] ?? date('Y-m'); if ($mensagem): ?><p style="color:red"><?= $mensagem ?></p><?php
$mes = $_GET['mes'] ?? date('Y-m'); endif; ?>
    <form method="POST">
        <input type="text" name="descricao" value="<?= htmlspecialchars($registro['descricao']) ?>" required>
        <input type="number" name="valor" step="0.01" value="<?= $registro['valor'] ?>" required>
        <select name="tipo" required>
            <option value="pagar" <?= $registro['tipo'] === 'pagar' ? 'selected' : '' ?>>Pagar</option>
            <option value="receber" <?= $registro['tipo'] === 'receber' ? 'selected' : '' ?>>Receber</option>
        </select>
        <input type="date" name="data" value="<?= $registro['data'] ?>" required>
        <button type="submit">Salvar</button>
    </form>
    <a href="relatorio.php?mes=<?= $mes ?>">← Voltar</a>
</div>
</body>
</html>
