<?php

require __DIR__ . "/vendor/autoload.php";

use App\Entity\Ingressos;
use App\Entity\Pedido;
use App\Entity\Caixa;

$ingressos = Ingressos::buscaIngressos($_GET['id']);
$somaQuantidade   = Pedido::getTotalIngressos();
$vendaAberta = Caixa::getVendas();

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/frente-pdv.php';
require_once __DIR__ . '/includes/footer.php';

?>