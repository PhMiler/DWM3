<?php
// Usuario.php - Arquivo responsável por funcionalidade específica do sistema
require_once 'Model.php';

// Classe responsável por funcionalidades específicas
/**
 * Classe Usuario
 *
 * Responsável por lidar com operações de usuario.
 */
/**
 * Classe Usuario
 *
 * Responsável por lidar com operações relacionadas a usuario.
 */
/**
 * Classe que representa a entidade e herda de Model.
 */
/**
 * Classe principal de controle.
 */
class Usuario extends Model {
    protected $table = "usuarios";

// Função que executa uma ação importante no fluxo
/**
 * Método cadastrar()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
/**
 * Cadastra um novo usuário no sistema
 *
 * @param string $nome Nome do usuário
 * @param string $email Email do usuário
 * @param string $senha Senha criptografada
 * @return bool True se o cadastro for realizado com sucesso
 */
    /**
 * Método cadastrar.
 *
 * @param mixed $$nome Descrição do parâmetro.
 * @param mixed $$email Descrição do parâmetro.
 * @param mixed $$senha Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function cadastrar($nome, $email, $senha) {
        try {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            return $this->inserir([
                'nome' => $nome,
                'email' => $email,
                'senha' => $hash
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return false; // e-mail duplicado
            }
            throw $e;
        }
    }

// Função que executa uma ação importante no fluxo
/**
 * Método buscarPorEmail()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
/**
 * Busca usuário no banco através do email
 *
 * @param string $email Email do usuário
 * @return array|null Retorna os dados do usuário ou null
 */
    /**
 * Método buscarPorEmail.
 *
 * @param mixed $$email Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function buscarPorEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = :email LIMIT 1");
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
