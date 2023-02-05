<?php

require __DIR__ . "/vendor/autoload.php";

use App\Entity\Ingressos;

$ingressos = Ingressos::buscaIngressos($_GET['id']);

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/frente-pdv.php';
require_once __DIR__ . '/includes/footer.php';

?>