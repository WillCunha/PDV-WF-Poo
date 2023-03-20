<?php



if($dados['dados'] === 0){
    $erro = "Não há eventos disponíveis hoje.";
    $href = "#";
    $titulo = "";
    $data = "";
}else{
    $erro = "";
    $href = "salva_evento.php?id=".$dados['dados']['id'];
    $titulo = $dados['dados']['titulo'];
    $data = "Data: " .$dados['dados']['data'];
}

?>
<section class="">
    <div class="centerHorizontal centerVertical">
        <h3 style="font-family: Roboto, sans-serif;">Selecione o evento:</h3>
        <div class="blocos" style="width: 50%;">
            <a href=" <?= $href ?> ">
                <h2 style="margin-bottom: 2%;"><?= $erro ?></h2>
                <h2 style="margin-bottom: 2%;"><?= $titulo ?></h2>
            </a>
                <h6><?= $data ?></h6>

            </div>
            <a href="#" style="display: grid; justify-items: center; margin-bottom: 2%;">
            <img src="src/images/Logotop.png" width="85" alt="">
        <p><?= date('Y')?> ©WF Software.</p> </a>
    </div>
</section>