<?php
    include_once("templates/header.php");
?>

<div class="container" id="view-disco-container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 id="main-title"><?= $categoria["nome"] ?></h1>
    <p class="bold">Observações:</p>
    <p><?= isset($categoria["observacao"]) ? $categoria["observacao"] : "Observação não disponível"; ?></p>
</div>