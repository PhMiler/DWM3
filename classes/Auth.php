<?php
// Auth.php - Arquivo responsável por funcionalidade específica do sistema
require_once 'Usuario.php';

// Classe responsável por funcionalidades específicas
/**
 * Classe Auth
 *
 * Responsável por lidar com operações de auth.
 */
/**
 * Classe Auth
 *
 * Responsável por lidar com operações relacionadas a auth.
 */
/**
 * Classe principal de controle.
 */
class Auth {
    private $usuario;

// Função que executa uma ação importante no fluxo
/**
 * Método __construct()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    /**
 * Método __construct.
 *
 * @param mixed $$db Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function __construct($db) {
        $this->usuario = new Usuario($db);
    }

// Função que executa uma ação importante no fluxo
/**
 * Método login()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    /**
 * Método login.
 *
 * @param mixed $$email Descrição do parâmetro.
 * @param mixed $$senha Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function login($email, $senha) {
        $usuario = $this->usuario->buscarPorEmail($email);
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            return true;
        }
        return false;
    }

// Função que executa uma ação importante no fluxo
/**
 * Método logout()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    /**
 * Método logout.
 *
 * @return mixed Resultado da operação.
 */
public function logout() {
        session_destroy();
    }
}
