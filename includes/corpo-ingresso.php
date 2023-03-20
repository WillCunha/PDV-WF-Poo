<?php

$tituloEvento = $evento['dados']['titulo'];
$dataEvento = $evento['dados']['data'];
$localEvento = $evento['dados']['local'];

$nomeIngresso = $_GET['nome'];
$rgIngresso = $_GET['rg'];

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
            <h1><?= $tituloEvento ?></h1>
        </div>
        <div class="headerDetalhes">
            <div class="linha">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                <p><?= $dataEvento ?></p>
            </div>
            <div class="linha">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <div class="local">
                    <p>Nome do Estabelecimento</p>
                    <p><?= $localEvento ?></p>
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
            <h2><?= $nomeIngresso ?></h2>
            <h2>RG: <?= $rgIngresso ?></h2>
        </div>
    </section>
    <section id="obs">

    </section>

</body>

</html>