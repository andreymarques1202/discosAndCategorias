<?php
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
    <h1 id="main-title">Editando Disco</h1>
    <form action="config/process.php" method="post" onsubmit="return validateForm()">
        <input type="hidden" name="type" value="edit">
        <input type="hidden" name="id" value="<?= $disco["id"] ?>">
        <div class="form-group">
            <label for="nome">Nome do Disco: </label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome do disco" value="<?= $disco["nome"]?>" required>
        </div>
        <div class="form-group">
            <label for="ano">Ano do Disco: </label>
            <input type="text" class="form-control" name="ano" id="ano" placeholder="Digite o ano do disco" value="<?= $disco["ano"] ?>" required>
        </div>
        <div class="form-group">
            <label for="categoriaId">Categoria do Disco: </label>
            <select name="categoriaId" id="categoriaId" class="form-control">
            <option value="Selecionar categoria">Selecionar categoria</option>    
            <?php foreach ($categorias as $categoria): ?>
                <?php $selected = ($categoria["id"] === $disco["categoriaId"]) ? 'selected' : ''; ?>
                    <option value="<?= $categoria["id"] ?>"><?= $categoria["nome"] ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" id="button">Atualizar</button>
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