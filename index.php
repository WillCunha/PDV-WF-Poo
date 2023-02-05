<?php

require __DIR__ . "/vendor/autoload.php";

use App\Entity\Eventos;

$dados = Eventos::getEventoData();

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/eventos.php';

?>