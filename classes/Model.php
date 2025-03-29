<?php
// Model.php - Arquivo responsável por funcionalidade específica do sistema
// Classe responsável por funcionalidades específicas
abstract /**
 * Classe principal de controle.
 */
class Model {
    protected $conn;
    protected $table;

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
        $this->conn = $db;
    }

// Função que executa uma ação importante no fluxo
/**
 * Método inserir()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    /**
 * Método inserir.
 *
 * @param mixed $array $dados Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function inserir(array $dados) {
        $campos = implode(", ", array_keys($dados));
        $valores = ":" . implode(", :", array_keys($dados));

        $sql = "INSERT INTO {$this->table} ($campos) VALUES ($valores)";
        $stmt = $this->conn->prepare($sql);
        foreach ($dados as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }
        return $stmt->execute();
    }

// Função que executa uma ação importante no fluxo
/**
 * Método listar()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    /**
 * Método listar.
 *
 * @return mixed Resultado da operação.
 */
public function listar() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// Função que executa uma ação importante no fluxo
/**
 * Método buscarPorId()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    /**
 * Método buscarPorId.
 *
 * @param mixed $$id Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

// Função que executa uma ação importante no fluxo
/**
 * Método atualizar()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    /**
 * Método atualizar.
 *
 * @param mixed $$id Descrição do parâmetro.
 * @param mixed $array $dados Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function atualizar($id, array $dados) {
        $campos = [];
        foreach ($dados as $campo => $valor) {
            $campos[] = "$campo = :$campo";
        }
        $campos_str = implode(", ", $campos);

        $sql = "UPDATE {$this->table} SET $campos_str WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        foreach ($dados as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }
        $stmt->bindValue(":id", $id);
        return $stmt->execute();
    }

// Função que executa uma ação importante no fluxo
/**
 * Método excluir()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
    /**
 * Método excluir.
 *
 * @param mixed $$id Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
