<?php
// login.php - Arquivo responsável por funcionalidade específica do sistema
session_start();
require_once '../config/Database.php';
require_once '../classes/Auth.php';

$db = (new Database())->connect();
$auth = new Auth($db);

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($auth->login($email, $senha)) {
        header("Location: dashboard.php");
        exit;
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
    <div class="container">
        <h2>Área de Acesso</h2>
        <?php if ($erro): ?>
            <p style="color:red;"><?= $erro ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="register.php">Criar uma conta</a>
    </div>
</body>
</html>
