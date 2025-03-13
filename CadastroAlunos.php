<?php
session_start();

// Classe Aluno
class Aluno {
    private $nome;
    private $matricula;
    private $curso;

    public function __construct($nome, $matricula, $curso) {
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->curso = $curso;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getCurso() {
        return $this->curso;
    }
}

// Classe CadastroAlunos
class CadastroAlunos {
    private $alunos = [];

    public function cadastrarAluno(Aluno $aluno) {
        $this->alunos[] = $aluno;
    }

    public function listarAlunos() {
        return $this->alunos;
    }
}

// Simulação de login
$usuarios = ["admin" => "1234"];
if (!isset($_SESSION['logado'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['senha'])) {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $senha) {
            $_SESSION['logado'] = true;
        } else {
            echo "<p style='color:red;'>Usuário ou senha inválidos!</p>";
        }
    }
}

// Se não estiver logado, exibir formulário de login
if (!isset($_SESSION['logado'])) {
    echo '<form method="post">
            Usuário: <input type="text" name="usuario" required>
            Senha: <input type="password" name="senha" required>
            <button type="submit">Login</button>
          </form>';
    exit;
}

// Criar instância do cadastro
$cadastro = new CadastroAlunos();

// Processamento do formulário de cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['matricula'], $_POST['curso'])) {
    $aluno = new Aluno($_POST['nome'], $_POST['matricula'], $_POST['curso']);
    $cadastro->cadastrarAluno($aluno);
    $_SESSION['alunos'][] = [$_POST['nome'], $_POST['matricula'], $_POST['curso']];
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

// Recuperar alunos da sessão
if (isset($_SESSION['alunos'])) {
    foreach ($_SESSION['alunos'] as $dados) {
        $cadastro->cadastrarAluno(new Aluno($dados[0], $dados[1], $dados[2]));
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
</head>
<body>
    <h2>Cadastrar Aluno</h2>
    <form method="post">
        Nome: <input type="text" name="nome" required>
        Matrícula: <input type="text" name="matricula" required>
        Curso: <input type="text" name="curso" required>
        <button type="submit">Cadastrar</button>
    </form>
    
    <h2>Lista de Alunos</h2>
    <ul>
        <?php foreach ($cadastro->listarAlunos() as $aluno): ?>
            <li><?php echo "Nome: " . htmlspecialchars($aluno->getNome()) . ", Matrícula: " . htmlspecialchars($aluno->getMatricula()) . ", Curso: " . htmlspecialchars($aluno->getCurso()); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
