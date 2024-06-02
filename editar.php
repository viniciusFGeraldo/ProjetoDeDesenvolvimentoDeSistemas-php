<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            header("Location: gerenciador-livros.php");
        }
    ?>

    <form action="" method="post">
        <label for="cod">Código:</label>
        <input type="text" name="cod" value="<?= $cod ?>" disabled>

        <br>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?= $titulo ?>">

        <br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" value="<?= $autor ?>">

        <br>
        <label for="genero">Gênero:</label>
        <input type="text" name="genero" value="<?= $genero ?>">

        <br>
        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="text" name="ano_publicacao" value="<?= $ano_publicacao ?>">

        <br>
        <label for="quantidade">Quantidade:</label>
        <input type="text" name="quantidade" value="<?= $quantidade ?>">

        <br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>