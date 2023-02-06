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
            'quantidade'  => $this->quantidade,
            'valor_un'    => $this->valor,
            'vlr_total'   => $this->valor_total,
            'status'      => 'aberto',
            'operador_id' => '1',
        ]);

        echo "<pre>";
        echo $this->id;
        echo "<pre>";
        die;

        return;

    }

}

?>