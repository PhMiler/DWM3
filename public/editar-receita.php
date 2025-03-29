<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$mes = $_GET['mes'] ?? date('Y-m');

require_once '../config/Database.php';
require_once '../classes/Receita.php';

$db = (new Database())->connect();
$receita = new Receita($db);

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: relatorio.php?mes=$mes");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $receita->editar($id, [
        'descricao' => $descricao,
        'valor' => $valor,
        'data' => $data
    ]);
    header("Location: relatorio.php?mes=$mes");
    exit();
}

$registro = $receita->buscarPorId($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Receita</title>
    <link rel="stylesheet" href="css/style.css?v=2">
</head>
<body>
<div class="container">
    <h2>Editar Receita</h2>
    <form method="post">
        <label>Descrição:</label><br>
        <input type="text" name="descricao" value="<?= $registro['descricao'] ?>" required><br><br>

        <label>Valor:</label><br>
        <input type="number" step="0.01" name="valor" value="<?= $registro['valor'] ?>" required><br><br>

        <label>Data:</label><br>
        <input type="date" name="data" value="<?= $registro['data'] ?>" required><br><br>

        <button type="submit">Salvar</button>
    </form>
    <p><a href="relatorio.php?mes=<?= $mes ?>">← Voltar ao Relatório</a></p>
</div>
</body>
</html>
