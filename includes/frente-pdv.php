<?php

$resultado = "";
foreach ($ingressos['dados'] as $retorno) {

    $resultado .= "<div class='container card'>
                    <div class='exibe-ingressos'>
                        <div class='header-ingressos'>
                            <h4>" . $retorno['nome_ingresso'] . "</h4>
                            <h5>R$ " . $retorno['valor'] . "</h5>
                        </div>
                        <p style='font-weight: 600;'>Quantidade disponível: " . $retorno['quantidade'] . "</p>
                        <input type='number' name='quantidade' id='quantidade' value='1' onkeypress='inpNum(event)'>
                        <button type='submit' id='adicionar'>Adicionar</button>
                    </div>
                </div>";
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
                <hr>
                <div class="contadores-eventos">
                    <div class="titulos-contadores">
                        <b>VALOR TOTAL: </b>
                        <b>QUANTIDADE DE INGRESSOS: </b>
                        <b class="total">Total de ingressos: </b>
                    </div>
                    <div class="numeros-contadores">
                        <b>0</b>
                        <b>0</b>
                        <b class="total"></b>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
<script>
    function inpNum(e) {
        e = e || window.event;
        var charCode = (typeof e.which == "undefined") ? e.keyCode : e.which;
        var charStr = String.fromCharCode(charCode);
        if (!charStr.match(/^[0-9]+$/))
            e.preventDefault();
    }
</script>