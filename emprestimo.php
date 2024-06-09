<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo de livros</title>
    <link rel="stylesheet" href="./style/emprestimo.css">
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
            echo "<a href='adicionar.php' class='nav-link'><button class='btn'>Adicionar Livro</button></a>";
            echo "<a href='emprestimos-ativo.php' class='nav-link'><button class='btn'>Emprestimos Ativos</button></a>";
            echo "<img src='./img/logo.jpg' alt='logo fundo cinza' class='logo'>";
            echo "</nav>";
        }
    }

    if (isset($_GET['idLivro'])) {
        $id_usuario = $_SESSION["usuario"];
        $id_livro = $_GET['idLivro'];
        emprestar($id_usuario, $id_livro);

        header("Location: ./emprestimo.php");
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
                    echo "<a href='emprestimo.php?idLivro=$obj_livro->id'><button>Emprestar</button></a>";
    
                    if (isAdmin($_SESSION["usuario"])) {
                        echo "<a href=\"editar.php?p=" . $obj_livro->id . "\"><button class='edit'>Editar</button></a> ";
                        echo "<a href=\"remover.php?p=" . $obj_livro->id . "\" onclick=\"return confirm('Tem certeza que deseja remover este livro?');\"><button class='delete'>Remover</button></a>";
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
