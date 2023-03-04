<?php

require __DIR__ . "/vendor/autoload.php";

use App\Entity\Pedido;

$vendasPendentes  = Pedido::buscaVendaPendente();

include_once __DIR__ .'/includes/header.php';
include_once __DIR__ .'/includes/ingressos-impressao.php';
include_once __DIR__ .'/includes/footer.php';

?>
