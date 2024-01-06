<?php 

include_once("templates/header.php");

?>

<div class="container">
    <?php 
        include_once("config/connection.php");

        try {
            $connect = new PDO("sqlite:$databasePath");
            $query = "SELECT id, nome, ano FROM discos";
            $stmt = $connect->query($query);
            $discos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    if(isset($printMsg) && $printMsg != ""): ?>
        <p id="msg"><?= $printMsg ?></p>
        <?php endif; ?>
        <h1 id="main-title">Meus Discos</h1>
        <?php if(!empty($discos) && count($discos) > 0): ?>
            <table class="table" id="discos-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ano</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($discos as $disco): ?>
                        <tr>
                            <td scope="row" class="col-id"><?= $disco["id"] ?></td>
                            <td scope="row"><?= $disco["nome"] ?></td>
                            <td scope="row"><?= $disco["ano"] ?></td>
                            <td class="actions">
                                <a href="show.php?id=<?= $disco["id"] ?>"><i class="fas fa-eye check-icon"></i></a>
                                <a href="edit.php?id=<?= $disco["id"] ?>"><i class="fas fa-edit edit-icon"></i></a>
                                <form action="config/process.php" method="POST" class="delete-form" onsubmit="return confirmDelete();">
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $disco["id"] ?>">
                                    <button type="submit" class="delete-btn"><i class="fas fa-trash delete-icon"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p id="empty-list-text">Ainda não há Discos na sua playlist, <a href="create.php">Clique aqui para adicionar</a>.</p>
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
        return confirm("Tem certeza que deseja excluir este disco?");
    }
</script>

<?php 
include_once("templates/footer.php");
?>