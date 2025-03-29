<?php
// dashboard.php - Arquivo responsável por funcionalidade específica do sistema
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/Database.php';
require_once '../classes/Usuario.php';

$db = (new Database())->connect();
$usuario = new Usuario($db);
$dados = $usuario->buscarPorId($_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css?v=2">
    <style>
        .menu {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
            margin-top: 20px;
        }
        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #1d4ed8;
            font-weight: 500;
        }
        .menu a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <p>Bem-vindo, <?= htmlspecialchars($dados['nome']) ?></p>

        <div class="menu">
            <a href="incluir-conta.php">➕ Incluir Conta</a>
            <a href="incluir-receita.php">💰 Incluir Receita</a>
            <a href="relatorio.php">📊 Ver Relatório</a>
            <a href="logout.php">📜 Sair</a>
        </div>
    </div>
</body>
</html>
