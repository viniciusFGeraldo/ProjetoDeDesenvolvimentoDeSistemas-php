<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="./style/form-livro.css">
    
    <style>
        #sair {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
<?php
    include 'banco.php';
    session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: login.php");
    }else{
        if (isAdmin($_SESSION["usuario"])) {
            echo "<nav class='header-nav'>";
            echo "<a href='emprestimo.php'><img src='./img/logo.jpg' alt='logo fundo cinza' class='logo'></a>";
            echo "<a href='adicionar.php' class='nav-link'><button class='btn btn-primary'>Adicionar Livro</button></a>";
            echo "<a href='emprestimos-ativo.php' class='nav-link'><button class='btn btn-primary'>Emprestimos Ativos</button></a>";
            echo "<a href='emprestimos-ativo-usuario.php' class='nav-link'><button class='btn btn-primary'>Empréstimos Ativos do Admin</button></a>";
            echo "<a href='logout.php' class='nav-link'><button class='btn btn-danger' style='width: 80px;'>Sair</button></a>";
            echo "</nav>";
        }else{
            header("Location: emprestimo.php");
        }
    }

    
?>


    <div class="container centered-container">
        <div class="form-container">
            <form action="" method="post">
            <legend class="mb-4">CADASTRO DE LIVRO:</legend>
                <fieldset>


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="titulo" id="titulo" required>
                        <label for="titulo">Título</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="autor" required>
                        <label for="autor">Autor</label>
                    </div>

                    <div class="form-floating mb-3">
                    <input type="text" class="form-control mb-3" name="genero" required>
                    <label for="genero">Gênero</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control mb-3" name="ano_publicacao" required>
                        <label for="ano_publicacao">Ano de Publicação</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control mb-3" name="quantidade" required>
                        <label for="quantidade">Quantidade</label>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="text-center">
                        <input type="submit" class="btn btn-success mt-3" value="Adicionar Livro">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <?php
        $usu = $_SESSION["usuario"] ?? null;

        if (is_null($usu)) {
            header("Location: login.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST["titulo"] ?? null;
            $autor = $_POST["autor"] ?? null;
            $genero = $_POST["genero"] ?? null;
            $ano_publicacao = $_POST["ano_publicacao"] ?? null;
            $quantidade = $_POST["quantidade"] ?? null;

            if (!is_null($titulo) && !is_null($autor) && !is_null($genero) && !is_null($ano_publicacao) && !is_null($quantidade)) {
                require_once "banco.php";
                $q = "INSERT INTO livros (titulo, autor, genero, ano_publicacao, quantidade) VALUES ('$titulo', '$autor', '$genero', '$ano_publicacao', '$quantidade')";
                $banco->query($q);
                header("Location: emprestimo.php");
                exit();
            } else {
                echo "Todos os campos são obrigatórios.";
            }
        }
    ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>