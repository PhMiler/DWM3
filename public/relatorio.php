<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/Database.php';
require_once '../classes/Conta.php';
require_once '../classes/Receita.php';

$db = (new Database())->connect();
$conta = new Conta($db);
$receita = new Receita($db);

$contas = $conta->listar();
$receitas = $receita->listar();

$totalContas = 0;
foreach ($contas as $c) {
    $totalContas += ($c['tipo'] === 'pagar') ? -$c['valor'] : $c['valor'];
}

$totalReceitas = 0;
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Relatório Financeiro</h2>

        <h3>Contas</h3>
        <table border="1" cellpadding="5" cellspacing="0" style="width:100%; margin-bottom: 20px;">
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Tipo</th>
                <th>Data</th>
            </tr>
            <?php foreach ($contas as $c): ?>
            <tr>
                <td><?= $c['descricao'] ?></td>
                <td>R$ <?= number_format($c['valor'], 2, ',', '.') ?></td>
                <td><?= ucfirst($c['tipo']) ?></td>
                <td><?= date('d/m/Y', strtotime($c['data'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h3>Receitas</h3>
        <table border="1" cellpadding="5" cellspacing="0" style="width:100%; margin-bottom: 20px;">
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Data</th>
            </tr>
            <?php foreach ($receitas as $r): ?>
            <tr>
                <td><?= $r['descricao'] ?></td>
                <td>R$ <?= number_format($r['valor'], 2, ',', '.') ?></td>
                <td><?= date('d/m/Y', strtotime($r['data'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h3>Resumo</h3>
        <p><strong>Total de Receitas:</strong> R$ <?= number_format($totalReceitas, 2, ',', '.') ?></p>
        <p><strong>Saldo das Contas:</strong> R$ <?= number_format($totalContas, 2, ',', '.') ?></p>
        <p><strong>Saldo Final:</strong> R$ <?= number_format($saldoFinal, 2, ',', '.') ?></p>

        <a href="dashboard.php">← Voltar ao Dashboard</a>
    </div>
</body>
</html>
