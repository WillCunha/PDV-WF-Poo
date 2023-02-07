<?php
require __DIR__ .'/vendor/autoload.php';

use App\Entity\Venda;

$vendaAberta = Venda::buscaVendaAberta();
$somaVenda   = Venda::getTotal();
$somaQuantidade   = Venda::getTotalIngressos();

foreach($vendaAberta as $venda){
    echo "<div class='itens'>";
    echo "<p>" .$venda->nome_ingresso. "</p>";
    echo "<p>" .sprintf("%02d", $venda->quantidade). "</p>";
    echo "<p style='text-align: right;'>R$ " .number_format($venda->vlr_total,2,",","."). "</p></br>";
    echo "</div>";
    }
    if(!$somaQuantidade < 1){
        echo "<hr>";
        echo "<div class='contadores-eventos'>";
        echo "<div class='titulos-contadores'>";
        echo "<b >QUANTIDADE DE INGRESSOS: </b>";
        echo "<b class='total'>VALOR TOTAL: </b>";
        echo "</div>";
        echo "<div class='numeros-contadores'>";
        echo "<P >".$somaQuantidade."</P>";
        echo "<p class='total'>R$ ".number_format($somaVenda,2,",",".")."</p>";
        echo "</div>";
        echo "</div>";
    }
?>