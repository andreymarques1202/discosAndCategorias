<?php

include_once("templates/header.php");

?>

<div class="container">
    <form action="config/process.php" method="post">
        <input type="hidden" name="type" value="createCategoria">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da categoria">
        </div>
        <div class="form-group">
            <label for="observacao">Observação</label>
            <input type="text" name="observacao" id="observacao" class="form-control" placeholder="Observações">
        </div>
        <button class="btn btn-dark" id="button" type="submit">Registrar</button>
    </form>
</div>

<?php
include_once("templates/footer.php");

?>