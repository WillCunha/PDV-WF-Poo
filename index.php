<?php

require __DIR__ . "/vendor/autoload.php";

use App\Entity\Eventos;

session_start();


if(isset($_SESSION['evento_id'])){

    header('Location: frente.php');
    exit;
    
}

$dados = Eventos::getEventoData();
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/eventos.php';

?>