<?php
namespace App\Entity;

use App\DB\database;
use PDO;

class Venda{

    /**
     * Pega o ID da venda
     */
    public $id;

    /**
     * Pega o ID do ingresso vendido
     */
    public $ingresso_id;

    /**
     * Pega o nome do ingresso
     */
    public $nome_ingresso;

    /**
     * Pega a quantidade vendida
     */
    public $quantidade;

    /**
     * Pega o valor unitário do ingresso
     */
    public $valor;

    /**
     * Pega o valor total da venda do ingresso
     */
    public $valor_total;

    /**
     * Função que registra a venda desde sua abertura até seu fechamento
     */
    public function abrevenda(){

        $this->valor_total = $this->valor * $this->quantidade;

        $obVenda = new Database("vendas");
        $this->id = $obVenda->insert([
            'ingresso_id' => $this->ingresso_id,
            'nome_ingresso'  => $this->nome_ingresso,
            'quantidade'  => $this->quantidade,
            'valor_un'    => $this->valor,
            'vlr_total'   => $this->valor_total,
            'status'      => 'aberto',
            'operador_id' => '1',
        ]);

        return;

    }

    static public function buscaVendaAberta(){
        return(new Database('vendas'))->select("status = 'aberto'")
                                        ->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Soma  total de ingressos vendidos em quantidade
     */
    static public function getTotalIngressos()
    {
        $aberto = "'aberto'";
        return (new Database('vendas'))->selectSum('status = ' . $aberto, 'quantidade')
            ->fetchColumn();
    }

    /**
     * Soma  total de ingressos vendidos em valor
     */
    static public function getTotal()
    {
        $aberto = "'aberto'";
        return (new Database('vendas'))->selectSum('status = ' . $aberto, 'vlr_total')
            ->fetchColumn();
    }

}
