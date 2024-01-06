<?php 

include_once("templates/header.php");

?>

<div class="container">
    <?php 
        include_once("config/connection.php");

        try {
            $connect = new PDO("sqlite:$databasePath");
            $query = "SELECT id, nome, observacao FROM categorias";
            $stmt = $connect->query($query);
            $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    if(isset($printMsg) && $printMsg != ""): ?>
        <p id="msg"><?= $printMsg ?></p>
        <?php endif; ?>
        <h1 id="main-title">Minhas Categorias</h1>
        <?php if(!empty($categorias) && count($categorias) > 0): ?>
            <table class="table" id="categorias-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categorias as $categoria): ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $categoria["id"] ?></td>
                            <td scope="row"><?= $categoria["nome"] ?></td>
                            <td class="actions">
                                <a href="observacaoCategoria.php?id=<?= $categoria["id"] ?>"><i class="fas fa-eye check-icon"></i></a>
                                <a href="editCategoria.php?id=<?= $categoria["id"] ?>"><i class="fas fa-edit edit-icon"></i></a>
                                <form action="config/process.php" method="POST" class="delete-form" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="type" value="deleteCategoria">
                                    <input type="hidden" name="id" value="<?= $categoria["id"] ?>">
                                    <button type="submit" class="delete-btn"><i class="fas fa-trash delete-icon"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p id="empty-list-text">Ainda não há Categorias disponivel, <a href="createCategoria.php">Clique aqui para adicionar</a>.</p>
                <?php endif; 
            } catch (PDOException $e) {
        $error = $e->getMessage();
        echo "Erro: $error";
    } finally {
        $connect = null; 
    }
    ?>
</div>

<script>
    function confirmDelete(id) {
        return confirm("Tem certeza que deseja excluir esta categoria?");
    }
</script>

<?php 
include_once("templates/footer.php");
?>