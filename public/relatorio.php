<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../config/Database.php';
require_once '../classes/Conta.php';
require_once '../classes/Receita.php';

$db = (new Database())->connect();
$conta = new Conta($db);
$receita = new Receita($db);

$mesSelecionado = $_GET['mes'] ?? date('Y-m');

// Exclusão de conta
if (isset($_GET['del_conta'])) {
    $conta->remover($_GET['del_conta']);
    header("Location: relatorio.php?mes=" . urlencode($mesSelecionado));
    exit();
}

// Exclusão de receita
if (isset($_GET['del_receita'])) {
    $receita->remover($_GET['del_receita']);
    header("Location: relatorio.php?mes=" . urlencode($mesSelecionado));
    exit();
}

if ($mesSelecionado) {
    [$ano, $mes] = explode('-', $mesSelecionado);
    $contas = $conta->buscarPorMes($ano, $mes);
    $receitas = $receita->buscarPorMes($ano, $mes);
}

$totalReceitas = 0;
$totalContas = 0;
foreach ($contas as $c) {
    $totalContas += ($c['tipo'] === 'pagar') ? $c['valor'] : -$c['valor'];
}
foreach ($receitas as $r) {
    $totalReceitas += $r['valor'];
}
$saldoFinal = $totalReceitas + $totalContas;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório Financeiro</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<div class="container">
    <h2>Relatório Financeiro</h2>

    <form method="get" class="form-filtro">
        <label for="mes">Filtrar por mês:</label>
        <input type="month" name="mes" value="<?= $mesSelecionado ?>" required>
        <button type="submit">Filtrar</button>
    </form>

    <h3>Contas</h3>
    <table>
        <tr><th>ID</th><th>Descrição</th><th>Valor</th><th>Tipo</th><th>Data</th><th>Ações</th></tr>
        <?php foreach ($contas as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['descricao'] ?></td>
            <td>R$ <?= number_format($c['valor'], 2, ',', '.') ?></td>
            <td><?= ucfirst($c['tipo']) ?></td>
            <td><?= date('d/m/Y', strtotime($c['data'])) ?></td>
            <td>
                <a href="editar-conta.php?id=<?= $c['id'] ?>&mes=<?= $mesSelecionado ?>">✏️ Editar</a> |
                <a href="relatorio.php?del_conta=<?= $c['id'] ?>&mes=<?= $mesSelecionado ?>" onclick="return confirm('Confirma exclusão?')">🗑️ Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Receitas</h3>
    <table>
        <tr><th>ID</th><th>Descrição</th><th>Valor</th><th>Data</th><th>Ações</th></tr>
        <?php foreach ($receitas as $r): ?>
        <tr>
            <td><?= $r['id'] ?></td>
            <td><?= $r['descricao'] ?></td>
            <td>R$ <?= number_format($r['valor'], 2, ',', '.') ?></td>
            <td><?= date('d/m/Y', strtotime($r['data'])) ?></td>
            <td>
                <a href="editar-receita.php?id=<?= $r['id'] ?>&mes=<?= $mesSelecionado ?>">✏️ Editar</a> |
                <a href="relatorio.php?del_receita=<?= $r['id'] ?>&mes=<?= $mesSelecionado ?>" onclick="return confirm('Confirma exclusão?')">🗑️ Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Resumo</h3>
    <p><strong>Total de Receitas:</strong> R$ <?= number_format($totalReceitas, 2, ',', '.') ?></p>
    <p><strong>Saldo das Contas:</strong> R$ <?= number_format($totalContas, 2, ',', '.') ?></p>
    <p><strong>Saldo Final:</strong> R$ <?= number_format($saldoFinal, 2, ',', '.') ?></p>
    <p><a href="dashboard.php">← Voltar ao Dashboard</a></p>
</div>
</body>
</html>
