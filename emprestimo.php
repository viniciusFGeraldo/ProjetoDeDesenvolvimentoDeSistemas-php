<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo de livros</title>
    <link rel="stylesheet" href="./style/emprestimo.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
            echo "<a href='adicionar.php' class='nav-link'><button class='btn'>Adicionar Livro</button></a>";
            echo "<a href='emprestimos-ativo.php' class='nav-link'><button class='btn'>Emprestimos Ativos</button></a>";
            echo "<a href='logout.php' class='nav-link'><button class='btn btn-danger' style='width: 80px;'>Sair</button></a>";
            echo "</nav>";
        }else{
            echo "<nav class='header-nav'>";
            echo "<a href='emprestimo.php'><img src='./img/logo.jpg' alt='logo fundo cinza' class='logo'></a>";
            echo "<a href='emprestimos-ativo-usuario.php' class='nav-link'><button class='btn'>Emprestimos Ativos</button></a>";
            echo "<a href='logout.php' class='nav-link'><button class='btn btn-danger'>Sair</button></a>";
            echo "</nav>";
        }


        if (isset($_GET['idLivro'])) {
            $id_usuario = $_SESSION["usuario"];
            $id_livro = $_GET['idLivro'];
            emprestar($id_usuario, $id_livro);

            if(isAdmin($_SESSION["usuario"])){
                echo "<script>window.location.href = 'emprestimos-ativo.php';</script>";

            }else{
                echo "<script>window.location.href = 'emprestimos-ativo-usuario.php';</script>";
            }
        }
    }

    
    ?>


    <h2 class="titulo">Lista de Livros:</h2>
    
    <?php 
        require_once "banco.php";

        $q = "SELECT * FROM livros";
        $busca = $banco->query($q);

        if ($busca->num_rows > 0) {
    ?>
    <div class="container-table">
        <table>
            <tr>
                <th>Código</th>
                <th>Titulo</th>
                <th>Autor</th>
                <th>Gênero</th>
                <th>Ano publicado</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
    
            <?php 
                while ($obj_livro = $busca->fetch_object()) { 
                    echo "<tr>";
                    echo "<td>$obj_livro->id</td>";
                    echo "<td>$obj_livro->titulo</td>";
                    echo "<td>$obj_livro->autor</td>";
                    echo "<td>$obj_livro->genero</td>";
                    echo "<td>$obj_livro->ano_publicacao</td>";
                    echo "<td>$obj_livro->quantidade</td>";
                    
                    echo "<td>";
                    echo "<a href='emprestimo.php?idLivro=$obj_livro->id'><button class='btn'>Emprestar</button></a>";
    
                    if (isAdmin($_SESSION["usuario"])) {
                        echo "<a href=\"editar.php?p=" . $obj_livro->id . "\"><button class='btn edit'>Editar</button></a> ";
                        echo "<a href=\"remover.php?p=" . $obj_livro->id . "\" onclick=\"return confirm('Tem certeza que deseja remover este livro?');\"><button class='btn delete'>Remover</button></a>";
                    }
                   
                    echo "</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>

    <?php 
        } else {
            echo "<p class='mensagem'>Nenhum livro encontrado.</p>";
            
        }
    ?>
</body>
</html>
