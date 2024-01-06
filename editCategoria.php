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
    <h1 id="main-title">Editando Categoria</h1>
    <form action="config/process.php" method="post">
        <input type="hidden" name="type" value="editCategoria">
        <input type="hidden" name="id" value="<?= $categoria["id"] ?>">
        <div class="form-group">
            <label for="nome">Nome da categoria: </label>
            <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome da categoria" value="<?= $categoria["nome"]?>" required>
        </div>
        <div class="form-group">
            <label for="ano">observações da categoria: </label>
            <input type="text" class="form-control" name="ano" id="ano" placeholder="Digite as observações" value="<?= $categoria["observacao"] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" id="button">Atualizar</button>
    </form>
</div>

<?php
    include_once("templates/footer.php");
?>