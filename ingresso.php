<?php

require __DIR__ . '/vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use App\Entity\Eventos;

session_start();
$id = $_SESSION['evento_id'];
$evento = Eventos::getEventoId($id);

$data = uniqid().rand().time();
$qr = '<img src="' . (new QRCode)->render($data) . '" width="150px" height="150px"/><h5>'.$data.'</h5>';



require __DIR__ . '/includes/corpo-ingresso.php';



?>