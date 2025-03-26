<?php
class Usuario {
    private $conn;
    private $table = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function cadastrar($nome, $email, $senha) {
        try {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $query = "INSERT INTO " . $this->table . " (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $hash);
            return $stmt->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return false; // e-mail duplicado
            }
            throw $e;
        }
    }

    public function listar() {
        $query = "SELECT id, nome, email, criado_em FROM " . $this->table . " ORDER BY criado_em DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $query = "SELECT id, nome, email FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
