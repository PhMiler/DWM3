<?php
// usuarios.php - Arquivo responsável por funcionalidade específica do sistema
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
require_once '../config/Database.php';
require_once '../classes/Usuario.php';

$db = (new Database())->connect();
$usuario = new Usuario($db);

$usuarios = $usuario->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
    <div class="container">
        <h2>Lista de Usuários</h2>

        <table border="1" cellpadding="5" cellspacing="0" style="width:100%; margin-bottom: 20px;">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Criado em</th>
            </tr>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= $u['nome'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['criado_em'] ?? '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <a href="dashboard.php">← Voltar ao Dashboard</a>
    </div>
</body>
</html>
