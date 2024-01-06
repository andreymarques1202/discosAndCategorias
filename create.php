<?php 
include_once("config/url.php");
include_once("templates/header.php");

$databasePath = __DIR__ . "/config/banco.sqlite";

try {
    $connect = new PDO("sqlite:$databasePath");
    $query = "SELECT id, nome FROM categorias";
    $stmt = $connect->query($query);
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = $e->getMessage();
    echo "Erro: $error";
}

?>

<div class="container">
    <?php include_once("templates/backbtn.html"); ?>
    <h1 id="main-title">Criando Disco</h1>
    <form action="config/process.php" method="post" onsubmit="return validateForm()">
        <input type="hidden" name="type" value="create">
        <div class="form-group">
            <label for="nome">Nome do Disco: </label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome do disco">
        </div>
        <div class="form-group">
            <label for="ano">Ano do Disco: </label>
            <input type="text" class="form-control" name="ano" id="ano" placeholder="Digite o ano do disco">
        </div>
        <div class="form-group">
            <label for="categoriaId">Categoria do Disco: </label>
            <select name="categoriaId" id="categoriaId" class="form-control">
            <option value="Selecionar categoria">Selecionar Categoria</option>   
            <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria["id"] ?>"><?= $categoria["nome"] ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" id="button">Registar</button>
    </form>
</div>

<script>
    function validateForm() {
        const categoriaSelect = document.getElementById("categoriaId");
        const selectValue = categoriaSelect.value;

        if (selectValue === "" || selectValue === "Selecionar categoria") {
            alert("por favor, Selecione uma categoria! Caso não haja categorias para selecionar crie uma categoria");
            return false;
        }

        return true;
    }
</script>

<?php
    include_once("templates/footer.php");
?>