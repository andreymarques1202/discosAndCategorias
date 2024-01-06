<?php
    include_once("templates/header.php");
?>

<div class="container" id="view-disco-container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 id="main-title"><?= $disco["nome"] ?></h1>
    <p class="bold">Ano:</p>
    <p><?= isset($disco["ano"]) ? $disco["ano"] : "Ano não disponível"; ?></p>
    <p class="bold">Categoria:</p>
    <p><?= isset($disco["categoria_nome"]) ? $disco["categoria_nome"] : "Categoria não encontrada"; ?></p>
    <p class="bold">Observações:</p>
    <p><?= isset($disco["categoria_observacao"]) ? $disco["categoria_observacao"] : "Observação não disponível"; ?></p>
</div>
