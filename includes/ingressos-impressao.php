<?php
session_start();
$id = $_SESSION['evento_id'];
$ingresso = "";
foreach ($vendasPendentes as $vendas) {
    if ($vendas->quantidade > 0) {

        $ingresso .= '<form action="ingresso.php"  method="POSTS" id="print' . $vendas->id . '">
        <div class="col-destaque">' . $vendas->nome_ingresso . ' <span id="quantidade' . $vendas->id . '">(' . sprintf('%02d', $vendas->quantidade) . ')</span></div>
        <input type="text" class="form-control" name="nomeIngresso' . $vendas->id . '" id="nomeIngresso' . $vendas->id . '" value="" placeholder="Nome inteiro" style="margin-bottom: 2%;margin-top: 2%;">
        <input type="text" class="form-control" name="rgIngresso' . $vendas->id . '" id="rgIngresso' . $vendas->id . '" value="" placeholder="RG">
        <button type="submit" id="print" style="width: 50%;font-size: 14px; margin-bottom: 2%;">GERAR INGRESSO</button>
         </form>
        <hr>
        <script>
            $(document).ready(function() {
                let quantidade = ' . $vendas->quantidade .';
                $("#print' . $vendas->id . '").submit(function(e) {
                    e.preventDefault();
                    if (quantidade > 0) {
                        var nomeIngresso = $("#nomeIngresso' . $vendas->id . '").val();
                        var rgIngresso = $("#rgIngresso' . $vendas->id . '").val();
                        console.log(nomeIngresso)
                        quantidade = quantidade - 1;
                        $("#quantidade' . $vendas->id . '").text("(" + quantidade + ")");
                        var url = "ingresso.php?id='.$id.'&&nome="+nomeIngresso+"&&rg="+rgIngresso;
                        window.open(url,"formpopup","toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=612,height=712,left = 312,top = 234");
                        this.target = "formpopup";
                    }
                })
            });
        </script>';
    }
}

?>

<section>
    <div id=" Home" class="tabcontent" style="display: block;width: 100%;padding: 15%;">
        <div class="line first">
            <div class="blocos corpo2" style="display: block;width: 100%">
                <div class="b-100">
                    <h4>Dados do(s) Ingresso(s):</h4>
                    <?= $ingresso; ?>
                </div>
            </div>
        </div>
    </div>
</section>

