<?php
// Receita.php - Arquivo responsável por funcionalidade específica do sistema
require_once 'Model.php';

/**
 * Classe Receita
 * Responsável por lidar com operações de receita.
 */
/**
 * Classe que representa a entidade e herda de Model.
 */
/**
 * Classe principal de controle.
 */
class Receita extends Model {
    protected $table = "receitas";

    /**
     * Insere uma nova receita no sistema
     *
     * @param string $descricao Descrição da receita
     * @param float $valor Valor recebido
     * @param string $data Data do recebimento
     * @return bool True em caso de sucesso
     */
    /**
 * Método inserirReceita.
 *
 * @param mixed $$descricao Descrição do parâmetro.
 * @param mixed $$valor Descrição do parâmetro.
 * @param mixed $$data Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function inserirReceita($descricao, $valor, $data) {
        return $this->inserir([
            'descricao' => $descricao,
            'valor' => $valor,
            'data' => $data
        ]);
    }

    /**
     * Atualiza os dados de uma receita existente
     *
     * @param int $id ID da receita
     * @param array $dados Dados atualizados
     * @return bool
     */
    /**
 * Método editar.
 *
 * @param mixed $$id Descrição do parâmetro.
 * @param mixed $$dados Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function editar($id, $dados) {
        return $this->atualizar($id, $dados);
    }

    /**
     * Remove uma receita
     *
     * @param int $id ID da receita
     * @return bool
     */
    /**
 * Método remover.
 *
 * @param mixed $$id Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function remover($id) {
        return $this->excluir($id);
    }

    /**
     * Busca registros por mês e ano
     *
     * @param int $ano
     * @param int $mes
     * @return array
     */
    /**
 * Método buscarPorMes.
 *
 * @param mixed $$ano Descrição do parâmetro.
 * @param mixed $$mes Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function buscarPorMes($ano, $mes) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE MONTH(data) = ? AND YEAR(data) = ?");
        $stmt->execute([$mes, $ano]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
