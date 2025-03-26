<?php
class Receita {
    private $conn;
    private $table = "receitas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function inserir($descricao, $valor, $data) {
        $query = "INSERT INTO " . $this->table . " (descricao, valor, data) 
                  VALUES (:descricao, :valor, :data)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":data", $data);
        return $stmt->execute();
    }

    public function listar() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY data DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
