<?php

$resultado = "";
foreach ($ingressos['dados'] as $retorno) {

    //Verifica se há venda aberta - se houver, desabilita o botão de "Adicionar", caso contrário, o habilita.
    $ternaria = ($vendaAberta > 0) ? "<button type='submit' class='disabled' id='adicionar'>Adicionar</button>" : "<button type='submit' id='adicionar' class='adicionar btn-venda'>Adicionar</button>";

    //Verifica se a quantidade de ingressos disponíveis forem = 0. Caso seja, marca o ingresso como esgotado e desabilita o botão "Adicionar".
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
                           " . $ternaria . "
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
                            capturaVendasAberta();
                        }
                    }).done(function(res) {
                        capturaVendasAberta();
                    })
                })
                </script>";
    }
}

?>
<div class="content">
    <section style="width: 100%; padding: 2%;height: 100vh;margin-top: 20%;">
        <div id=" Home" class="tabcontent">
            <div class="line first">
                <div class="blocos corpo2">

                    <?= $resultado; ?>

                    <div class="b-100" style="display: none;">
                        <h4>Dados do(s) Ingresso(s):</h4>

                        <div id="impressao"></div>

                    </div>
                </div>
                <div class="blocos corpo1">
                    <h4>FINALIZADORA:</h4>
                    <p></p>
                    <h1 style="text-align: center; font-size: 3.5rem;"></h1>

                    <div id="lista"></div>

                    <hr>
                    <div class="finalizadora">
                        <form action="recebe-venda.php" method="post" id='recebe-venda'>
                            <input type="hidden" id="areceber" name="areceber" value="0">
                            <select name="metodo" id="metodo">
                                <option value="dinheiro">Dinheiro</option>
                                <option value="credito">Crédito</option>
                                <option value="debito">Débito</option>
                                <option value="pix">Pix</option>
                            </select>
                            <input type="text" name="valor" id="valor" class="quantidade" placeholder="0.00" style="width: 100%;">
                            <button type='submit' id='recebe-venda'>CONTINUAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        setInterval(capturaVendasAberta, 500);
        jQuery('.disabled').prop('disabled', true);

        $("#valor").maskMoney({
            showSymbol: true,
            symbol: "R$",
            decimal: ".",
            thousands: "."
        });

        function inpNum(e) {
            e = e || window.event;
            var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
            var charStr = String.fromCharCode(charCode);
            if (!charStr.match(/^[0-9]+$/))
                e.preventDefault();
        }


        function capturaVendasAberta() {
            $.ajax({
                type: 'GET',
                url: 'venda-aberta.php',
                dataType: 'html',
                success(response) {
                    $('#lista').html(response);
                }
            })
        }

        $('#recebe-venda').submit(function(e) {
            e.preventDefault();
            var formData = {
                metodo: $('#metodo').val(),
                valor: $('#valor').val(),
            };
            $('.btn-venda').addClass('disabled');
            $('.btn-venda').removeClass('adicionar');
            $('#recebe-venda').trigger('reset');
            jQuery('.disabled').prop('disabled', true);
            console.log(formData);
            $.ajax({
                type: 'POST',
                url: 'recebe-venda.php',
                data: formData,
                dataType: 'json',
                encode: true,
                success: function(res) {
                    if (res.status == 200) {
                        console.log(res);
                    } else if (res.status == 400) {
                        $('.btn-venda').addClass('adicionar');
                        $('.btn-venda').removeClass('disabled');
                        jQuery('.btn-venda').prop('disabled', false);
                        let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
width=600,height=600,left=100,top=100`;
                        open('gera-ingresso.php', 'test', params);
                    }
                }
            });
        })
    </script>
    </script>