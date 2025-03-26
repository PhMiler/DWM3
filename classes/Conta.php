<?php
class Conta {
    private $conn;
    private $table = "contas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function inserir($descricao, $valor, $tipo, $data) {
        $query = "INSERT INTO " . $this->table . " (descricao, valor, tipo, data) 
                  VALUES (:descricao, :valor, :tipo, :data)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":tipo", $tipo);
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
