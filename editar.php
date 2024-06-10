<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/form-livro.css">
</head>
<body>
    <?php
        session_start();
        $usu = $_SESSION["usuario"] ?? null;

        if (is_null($usu)) {
            header("Location: login.php");
        }

        $cod = $_GET["p"] ?? null;
        $titulo = $_POST["titulo"] ?? null;
        $autor = $_POST["autor"] ?? null;
        $genero = $_POST["genero"] ?? null;
        $ano_publicacao = $_POST["ano_publicacao"] ?? null;
        $quantidade = $_POST["quantidade"] ?? null;

        if (is_null($cod)) {
            echo "Nenhum livro para editar";
            return;
        }

        require_once "banco.php";

        if (is_null($titulo) || is_null($autor) || is_null($genero) || is_null($ano_publicacao) || is_null($quantidade)) {
            $q = "SELECT titulo, autor, genero, ano_publicacao, quantidade FROM livros WHERE id='$cod'";
            $busca = $banco->query($q);
            $obj_livro = $busca->fetch_object();
            $titulo = $obj_livro->titulo;
            $autor = $obj_livro->autor;
            $genero = $obj_livro->genero;
            $ano_publicacao = $obj_livro->ano_publicacao;
            $quantidade = $obj_livro->quantidade;
        } else {
            $q = "UPDATE livros SET titulo='$titulo', autor='$autor', genero='$genero', ano_publicacao='$ano_publicacao', quantidade='$quantidade' WHERE id='$cod'";
            $banco->query($q);
            header("Location: emprestimo.php");
        }
    ?>
    <img src="./img/logoBranca.jpg" alt="logo com fundo branco" class="logo">
    <div class="container centered-container">
        <form action="" method="post">
            <fieldset>
                <legend>EDITAR LIVRO:</legend>
                <label for="cod">Código:</label>
                <input type="text" class="form-control mb-3" name="cod" value="<?= $cod ?>" disabled>
    
                <label for="titulo">Título:</label>
                <input type="text" class="form-control mb-3" name="titulo" value="<?= $titulo ?>" required>

                <label for="autor">Autor:</label>
                <input type="text" class="form-control mb-3" name="autor" value="<?= $autor ?>" required>

                <label for="genero">Gênero:</label>
                <input type="text" class="form-control mb-3" name="genero" value="<?= $genero ?>" required>

                <label for="ano_publicacao">Ano de Publicação:</label>
                <input type="text" class="form-control mb-3" name="ano_publicacao" value="<?= $ano_publicacao ?>" required>

                <label for="quantidade">Quantidade:</label>
                <input type="text" class="form-control mb-3" name="quantidade" value="<?= $quantidade ?>" required>

                <div class="text-center">
                    <input type="submit" class="btn btn-success mt-3" value="Salvar">
                </div>

            </fieldset>
        </form>
    </div>
</body>
</html>