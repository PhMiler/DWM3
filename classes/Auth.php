<?php
class Auth {
    private $conn;
    private $table = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $senha) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senha'])) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id'];
                return true;
            }
        }
        return false;
    }
}
