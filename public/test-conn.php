<?php
// test-conn.php - Arquivo responsável por funcionalidade específica do sistema
try {
    $pdo = new PDO("mysql:host=localhost;port=3308;dbname=financeiro", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Conexão com PDO bem-sucedida!";
} catch (PDOException $e) {
    echo "❌ Erro: " . $e->getMessage();
}
