<?php

require_once __DIR__.'/vendor/autoload.php';

use App\Entity\Pedido;
use App\Entity\Caixa;
use App\API\Envia;

session_start();

$somaVenda   = Pedido::getTotal();
$totalRecebido = Caixa::totalPago();
$transfere = new Envia();
$idEvento = $_SESSION['evento_id'];

if(isset($_POST['valor'])){

    $vFinal = $totalRecebido + $_POST['valor'];

    $registradora = new Caixa();
    $registradora->valor = $_POST['valor'];
    $registradora->metodo = $_POST['metodo'];
    $registradora->registraCreditoCaixa();

    if($vFinal >= $somaVenda){
        $itens = $registradora->selectVendas();
        foreach($itens as $dados){
            $registradora->id = $dados->id;
            $registradora->atualizaRegistro();      
        }
        $pedido = new Pedido();
        $venda = $pedido->buscaVendaAberta();
        foreach($venda as $dadosVenda){
            $pedido->id = $dadosVenda->id;
            $ingresso_id = $dadosVenda->ingresso_id;
            $quantidade = $dadosVenda->quantidade;
            $pedido->atualizaRegistro();        
            $array[] = ['id_evento' => $idEvento, 'id_ingresso' => $ingresso_id, 'quantidade' => $quantidade];
            $retorno = $pedido->atualizaRegistro();        
        }
        $encode = json_encode($array);
        $transfere->enviaCentral($encode);

        $final = json_encode([ 'status' => 400 ]);  
    }else{
        
        $final = json_encode([ 'status' => 200 ]);
    }

    echo $final;

}
