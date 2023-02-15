<?php

require __DIR__ . "/vendor/autoload.php";

use App\Entity\Pedido;

$vendasPendentes  = Pedido::buscaVendaPendente();

foreach ($vendasPendentes as $vendas ){
    echo '<form action="" method="post">';
    echo '<div class="col-destaque">'.$vendas->nome_ingresso.'</div>';
    echo '<input type="text" class="form-control" name="nomeIngresso'.$vendas->id.'" id="nomeIngresso'.$vendas->id.'" value="" placeholder="Nome inteiro" style="margin-bottom: 2%;margin-top: 2%;">';
    echo '<input type="text" class="form-control" name="rgIngresso'.$vendas->id.'" id="rgIngresso'.$vendas->id.'" value="" placeholder="RG">';
    echo '<button type="submit" id="print" style="width: 30%;font-size: 14px; margin-bottom: 2%;">GERAR INGRESSO</button>';
    echo ' </form>';
    echo '<hr>';
}

?>