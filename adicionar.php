<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .titulo {
            text-align: center;
            font-size: 20px;
            margin: 10px 0 30px 0;
        }
        .logo{
            position: absolute;
            left: 15px;
            top: 15px;
            
            width: 200px;
        }
        .centered-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .form-container {
            width: 100%;
            max-width: 400px;
        }
        legend{
            text-align: center;
            color: red;
        }
        .btn{
            align-items: center;
        }
    </style>
</head>
<body>
    <img src="./img/logoBranca.jpg" alt="logo com fundo branco" class="logo">
    <div class="container centered-container">
        <h1 class="titulo">Preencha os campos abaixo para adicionar um novo livro:</h1>
        <div class="form-container">
            <form action="" method="post">
                <fieldset>
                    <legend>CADASTRO DE LIVRO:</legend>
                    
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control mb-3" name="titulo" required>
                    
                    <label for="autor">Autor:</label>
                    <input type="text" class="form-control mb-3" name="autor" required>
                    
                    <label for="genero">Gênero:</label>
                    <input type="text" class="form-control mb-3" name="genero" required>
                    
                    <label for="ano_publicacao">Ano de Publicação:</label>
                    <input type="number" class="form-control mb-3" name="ano_publicacao" required>
                    
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" class="form-control mb-3" name="quantidade" required>
                    
                    <div class="text-center">
                        <input type="submit" class="btn btn-success mt-3" value="Adicionar Livro">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <?php
        session_start();
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
</html>