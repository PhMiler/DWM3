<?php
// register.php - Arquivo responsável por funcionalidade específica do sistema
session_start();
require_once '../config/Database.php';
require_once '../classes/Usuario.php';

$db = (new Database())->connect();
$usuario = new Usuario($db);

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($usuario->cadastrar($nome, $email, $senha)) {
        $mensagem = "Usuário cadastrado com sucesso!";
    } else {
        $mensagem = "E-mail já cadastrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <?php if ($mensagem): ?>
            <p><?= $mensagem ?></p>
        <?php endif; ?>
        <form method="POST" novalidate>
            <input type="text" name="nome" placeholder="Nome completo" required minlength="3"
                oninvalid="this.setCustomValidity('Digite seu nome completo')"
                oninput="this.setCustomValidity('')">

            <input type="email" name="email" placeholder="E-mail válido" required
                oninvalid="this.setCustomValidity('Informe um e-mail válido')"
                oninput="this.setCustomValidity('')">

            <input type="password" name="senha" placeholder="Senha (mínimo 6 caracteres)" required minlength="6"
                oninvalid="this.setCustomValidity('A senha deve ter pelo menos 6 caracteres')"
                oninput="this.setCustomValidity('')">

            <button type="submit">Registrar</button>
        </form>
        <a href="login.php">← Voltar para Login</a>
    </div>
</body>
</html>
