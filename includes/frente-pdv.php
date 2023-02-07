<?php

$resultado = "";
foreach ($ingressos['dados'] as $retorno) {

    if ($retorno['quantidade'] === '0') {
        $resultado .= "<div class='container card'>
        <div class='exibe-ingressos'>
            <div class='header-ingressos'>
                <h4>" . $retorno['nome_ingresso'] . "</h4>
                <h5>ESGOTADO!</h5>
            </div>
            <p style='font-weight: 600;color: #c00;'>Quantidade disponível: " . $retorno['quantidade'] . "</p>
            <input type='number' name='id" . $retorno['id'] . "' id='id" . $retorno['id'] . "' value='" . $retorno['id'] . "' onkeypress='inpNum(event)' hidden>
            <input type='number' name='quantidade' class='quantidade' id='quantidade' value='1' onkeypress='inpNum(event)'>
            <button type='submit' class='disabled' id='adicionar'>Adicionar</button>
        </div>
    </div>";
    } else {
        $resultado .= "<div class='container card'>
                    <div class='exibe-ingressos'>
                        <div class='header-ingressos'>
                            <h4>" . $retorno['nome_ingresso'] . "</h4>
                            <h5>R$ " . $retorno['valor'] . "</h5>
                        </div>
                        <p style='font-weight: 600;'>Quantidade disponível: " . $retorno['quantidade'] . "</p>
                        <form action='envia-compra.php' method='post' id='envia-compra" . $retorno['id'] . "'>
                            <input type='number' name='id' id='id" . $retorno['id'] . "' value='" . $retorno['id'] . "' onkeypress='inpNum(event)' hidden>
                            <input type='text' name='nome_ingresso' id='nome_ingresso" . $retorno['id'] . "' value='" . $retorno['nome_ingresso'] . "' onkeypress='inpNum(event)' hidden>
                            <input type='number' name='valor' id='valor" . $retorno['id'] . "' value='" . $retorno['valor'] . "' onkeypress='inpNum(event)' hidden>
                            <input type='number' name='quantidade' class='quantidade' id='quantidade" . $retorno['id'] . "' value='1' onkeypress='inpNum(event)'>
                            <button type='submit' id='adicionar'>Adicionar</button>
                        </form>
                    </div>
                </div>
                <script>
                $('#envia-compra" . $retorno['id'] . "').submit(function(e) {
                    e.preventDefault();
                    var formData = {
                        id: $('#id" . $retorno['id'] . "').val(),
                        nome_ingresso: $('#nome_ingresso" . $retorno['id'] . "').val(),
                        quantidade: $('#quantidade" . $retorno['id'] . "').val(),
                        valor: $('#valor" . $retorno['id'] . "').val()
                    };
                    console.log(formData);
                    $.ajax({
                        type: 'POST',
                        url: 'envia-compra.php',
                        data: formData,
                        dataType: 'json',
                        encode: true,
                        success: function(res){
                            console.log(res);
                        }
                    }).done(function(res) {
                        console.log(data);
                    })
                })
                </script>";
    }
}

?>
<div class="content">
    <section style="width: 100%; padding: 2%;">
        <div id="Home" class="tabcontent">
            <div class="line first">
                <div class="blocos corpo2">

                    <?= $resultado; ?>

                </div>
                <div class="blocos corpo1">
                    <h4>FINALIZADORA:</h4>
                    <p></p>
                    <h1 style="text-align: center; font-size: 3.5rem;"></h1>
                    <div id="lista">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

        setInterval(capturaVendasAberta, 500);
        jQuery('.disabled').prop('disabled', true);

        function inpNum(e) {
            e = e || window.event;
            var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
            var charStr = String.fromCharCode(charCode);
            if (!charStr.match(/^[0-9]+$/))
                e.preventDefault();
        }

        function capturaVendasAberta() {
            $.ajax({
                type: "GET",
                url: "venda-aberta.php",
                dataType: "html",
                success(response) {
                    console.log(response)
                    $("#lista").html(response);
                }
            })
        }
    </script>