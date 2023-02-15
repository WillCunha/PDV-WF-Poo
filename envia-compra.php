<?php
require __DIR__ . '/vendor/autoload.php';

use App\Entity\Pedido;

if(isset($_POST['id'], $_POST['quantidade'])){

    $abreVenda = new Pedido();
    $abreVenda->ingresso_id = $_POST['id'];
    $abreVenda->nome_ingresso  = $_POST['nome_ingresso'];
    $abreVenda->quantidade  = $_POST['quantidade'];
    $abreVenda->valor  = $_POST['valor'];
    $abreVenda->abrevenda();
    
    header("Location: frente.php");

}

?>