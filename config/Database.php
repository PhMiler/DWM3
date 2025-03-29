<?php
// Database.php - Responsável pela conexão com o banco de dados
// Classe responsável por funcionalidades específicas
/**
 * Classe Database
 *
 * Responsável por lidar com operações de database.
 */
/**
 * Classe Database
 *
 * Responsável por lidar com operações relacionadas a database.
 */
class Database {
    private $host = "localhost";
    private $db_name = "financeiro";
    private $username = "root";
    private $password = "";
    private $port = "3308";
    public $conn;

// Função que executa uma ação importante no fluxo
/**
 * Método connect()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
