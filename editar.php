<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/form-livro.css">

</head>
<body>
    <?php
        include 'banco.php';
        session_start();

        if (isAdmin($_SESSION["usuario"])) {
            echo "<nav class='header-nav'>";
            echo "<a href='emprestimo.php'><img src='./img/logo.jpg' alt='logo fundo cinza' class='logo'></a>";
            echo "<a href='adicionar.php' class='nav-link'><button class='btn'>Adicionar Livro</button></a>";
            echo "<a href='emprestimos-ativo.php' class='nav-link'><button class='btn'>Empréstimos Ativos</button></a>";
            echo "<a href='emprestimos-ativo-usuario.php' class='nav-link'><button class='btn'>Empréstimos Ativos Ativos do Admin</button></a>";
            echo "<a href='logout.php' class='nav-link'><button class='btn btn-danger' style='width: 80px;'>Sair</button></a>";
            echo "</nav>";
        }else{
            header("Location: emprestimo.php");
        }

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