<?php

require __DIR__ . '/vendor/autoload.php';

use chillerlan\QRCode\QRCode;

$data = uniqid().rand().time();
$qr = '<img src="' . (new QRCode)->render($data) . '" width="150px" height="150px"/><h5>'.$data.'</h5>';

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="src/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700" rel="stylesheet" />
</head>

<body class="ingressoCorpo">


    <section id="headerIngresso">
        <div class="headerTitulo">
            <h1>Nome evento</h1>
        </div>
        <div class="headerDetalhes">
            <div class="linha">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                <p>20 de jan 2022, 23h às 05h.</p>
            </div>
            <div class="linha">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <div class="local">
                    <p>Nome do Estabelecimento</p>
                    <p>Rua Tal, n° 123, Bairro Tal | Mogi Mirim - SP.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="midIngresso">
        <div class="dadosIngresso">
            <h3>Ingresso:</h3>
            <h2>Open Bar</h2>
            <h2>R$ 149.99</h2>
            <p>Comprado em 15/02/2023.</p>
        </div>
        <div class="dadosQR">
            <?= $qr ?>
        </div>
    </section>
    <section id="midIngresso">
        <div class="dadosParticipante">
            <h3>Participante:</h3>
            <h2>Willian Fernando da Cunha</h2>
            <h2>RG: 54.832.603-4</h2>
        </div>
    </section>
    <section id="obs">

    </section>

</body>

</html>