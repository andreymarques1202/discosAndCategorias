<?php 
    session_start();

    include_once("connection.php");
    include_once("url.php");

    $data = $_POST;

    if(!empty($data)) {
        $type = $data["type"];
        $nome = $data["nome"];
        $ano = $data["ano"];
        $observacao = $data["observacao"];
        if($type === "createCategoria" || $type === "create") {
            if ($type === "create") {
                $categoriaId = $data["categoriaId"];
                $query = "INSERT INTO discos (nome, ano, categoria_Id) VALUES (:nome, :ano, :categoriaId)";
            $stmt = $connect->prepare($query);
    
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":ano", $ano);
            $stmt->bindParam(":categoriaId", $categoriaId);
    
            try {
                $stmt->execute();
                $_SESSION["msg"] = "Disco Adicionado!";
            } catch(PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }
    
            header("Location: ../index.php");
            exit;

            } else {
                 $query = "INSERT INTO categorias (nome, observacao) VALUES (:nome, :observacao)";
            $stmt = $connect->prepare($query);

            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":observacao", $observacao);

            try {
                $stmt->execute();
                $_SESSION["msg"] = "Categoria Adicionada!";
            } catch(PDOException $e) {
                $error = $e->getMessage();
                echo "Erro: $error";
            }
            header("Location: ../showCategoria.php");
            exit;
            }
        } 

        if($type === "editCategoria" || $type === "edit") {
            if($type === "edit") {
                $categoriaId = $data["categoriaId"];
                $id = $data["id"];
    
                $query = "UPDATE discos SET nome = :nome, ano = :ano, categoria_id = :categoriaId WHERE id = :id";
        
                $stmt = $connect->prepare($query);
        
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":ano", $ano);
                $stmt->bindParam(":categoriaId", $categoriaId);
                $stmt->bindParam(":id", $id);
        
                try {
                    $stmt->execute();
                    $_SESSION["msg"] = "Disco atualizado!";
                } catch(PDOException $e) {
                    $error = $e->getMessage();
                    echo "Erro: $error";
                }
                header("Location: ../index.php");
                exit;
        } else {
            $id = $data["id"];
            $query = "UPDATE categorias SET nome = :nome, observacao = :observacao WHERE id = :id";
    
                $stmt = $connect->prepare($query);
    
                $stmt->bindParam(":nome", $nome);
                $stmt->bindParam(":observacao", $observacao);
                $stmt->bindParam(":id", $id);
    
                try {
                    $stmt->execute();
                    $_SESSION["msg"] = "Categoria atualizada!";
                } catch(PDOException $e) {
                    $error = $e->getMessage();
                    echo "Erro: $error";
                }
    
                header("Location: ../showCategoria.php");
            exit;
        }
        }
        
    if($type === "delete") {
        $id = $data["id"];

        $query = "DELETE FROM discos WHERE id = :id";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(":id", $id);

        try {
            $stmt->execute();
            $_SESSION["msg"] = "Disco Deletado com sucesso!";
        } catch(PDOException $e) {
            $error = $e->getMessage();
            echo "Erro: $error";
        }
        header("Location: ../index.php");
        exit;

        } else {
            $id = $data["id"];
            $query = "DELETE FROM categorias WHERE id = :id";
        $stmt = $connect->prepare($query);
        $stmt->bindParam(":id", $id);

        try {
            $stmt->execute();
            $_SESSION["msg"] = "Categoria Deletada com sucesso!";
        } catch(PDOException $e) {
            $error = $e->getMessage();
            echo "Erro: $error";
        }
        header("Location: ../showCategoria.php");
        exit;
    }
    } else {
        $id;

        if(!empty($_GET["id"])) {
            $id = $_GET["id"];
        }

        if(!empty($id)) {
            $queryCategoria = "SELECT * FROM categorias WHERE id = :id";

            $stmt = $connect->prepare($queryCategoria);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $categoria = $stmt->fetch();

            $queryDisco = "SELECT discos.*, categorias.nome AS categoria_nome, categorias.observacao AS categoria_observacao
                   FROM discos
                   JOIN categorias ON discos.categoria_id = categorias.id
                   WHERE discos.id = :id";

            $stmt = $connect->prepare($queryDisco);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $disco = $stmt->fetch();
            
        } else {
            $categorias = [];
            $discos = [];
            $queryCategoria = "SELECT * FROM categorias";
            $queryDisco = "SELECT * FROM discos";
            
            $stmt = $connect->prepare($queryDisco);
            $stmt->execute();
            $stmt = $connect->prepare($queryCategoria);
            $stmt->execute();

            $categorias = $stmt->fetchAll();
            $discos = $stmt->fetchAll();
        }
    }

    $connect = null;
?>