<?php
// Conta.php - Arquivo responsável por funcionalidade específica do sistema
require_once 'Model.php';

// Classe responsável por funcionalidades específicas
/**
 * Classe Conta
 *
 * Responsável por lidar com operações de conta.
 */
/**
 * Classe Conta
 *
 * Responsável por lidar com operações relacionadas a conta.
 */
/**
 * Classe que representa a entidade e herda de Model.
 */
/**
 * Classe principal de controle.
 */
class Conta extends Model {
    protected $table = "contas";

// Função que executa uma ação importante no fluxo
/**
 * Método inserirConta()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
/**
 * Insere uma nova conta no banco de dados
 *
 * @param string $descricao Descrição da conta
 * @param float $valor Valor da conta
 * @param string $tipo Tipo da conta (pagar ou receber)
 * @param string $data Data da conta
 * @return bool True se a conta for inserida com sucesso
 */
    /**
 * Método inserirConta.
 *
 * @param mixed $$descricao Descrição do parâmetro.
 * @param mixed $$valor Descrição do parâmetro.
 * @param mixed $$tipo Descrição do parâmetro.
 * @param mixed $$data Descrição do parâmetro.
 * @return mixed Resultado da operação.
 */
public function inserirConta($descricao, $valor, $tipo, $data) {
        return $this->inserir([
            'descricao' => $descricao,
            'valor' => $valor,
            'tipo' => $tipo,
            'data' => $data
        ]);
    }

// Função que executa uma ação importante no fluxo
/**
 * Método editar()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
/**
 * Atualiza os dados de uma conta existente
 *
 * @param int $id ID da conta a ser atualizada
 * @param array $dados Dados a serem atualizados
 * @return bool True se a atualização for bem-sucedida
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

// Função que executa uma ação importante no fluxo
/**
 * Método remover()
 * Descreva aqui o que essa função faz.
 *
 * @return void
 */
/**
 * Remove uma conta do banco de dados
 *
 * @param int $id ID da conta a ser removida
 * @return bool True se a remoção for bem-sucedida
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
     * @param int $ano Ano desejado
     * @param int $mes Mês desejado
     * @return array Lista de registros do mês
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