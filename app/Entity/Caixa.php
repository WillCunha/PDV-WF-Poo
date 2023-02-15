<?php

namespace App\Entity;

use App\DB\Database;
use PDO;

class Caixa
{

    /**
     * ID do registro
     */
    public $id;

    /**
     * Valor recebido
     */
    public $valor;

    /**
     * Método de pagamento
     */
    public $metodo;


    /**
     * Função responsável por registrar as entradas de valores no caixa
     */

    public function registraCreditoCaixa()
    {

        $banco = new Database('caixa');
        $this->id = $banco->insert([
            'valor' => $this->valor,
            'metodo' => $this->metodo,
            'status' => 'aberto'
        ]);

        return $this->id;
    }

    /**
     * Pega todas os registros de venda como "aberto" os fecha
     */
    public function atualizaRegistro()
    {
        return (new Database('caixa'))->update('id = ' . $this->id, [
            'status' => 'fechado',
        ]);
    }

    /**
     * Pega todas as vendas abertas
     */
    static public function selectVendas()
    {
        return (new Database('caixa'))->select('status = "aberto"')
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /**
     * Verifica se há alguma venda como "aberta"
     */
    static public function getVendas()
    {
        return (new Database('caixa'))->select('status = "aberto"')
            ->rowCount();
    }

    /**
     * Pega o valor total do que já foi pago
     */
    static public function totalPago()
    {
        $aberto = "'aberto'";
        return (new Database('caixa'))->selectSum('status = ' . $aberto, 'valor')
            ->fetchColumn();
    }
}
