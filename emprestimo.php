<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include 'banco.php';
    session_start();

    if(!isset($_SESSION["usuario"])){
        header("Location: login.php");
    }else{
        if (isAdmin($_SESSION["usuario"])) {
            echo "<a href='adicionar.php'><button>Adicionar Livro</button></a>";
            echo "<a href='emprestimos-ativo.php'><button>Emprestimos Ativos</button></a>";
        }
    }

    if (isset($_GET['idLivro'])) {
        $id_usuario = $_SESSION["usuario"];
        $id_livro = $_GET['idLivro'];
        emprestar($id_usuario, $id_livro);

        header("Location: ./emprestimo.php");
    }
    ?>


    <h2>Lista de Livros</h2>
    
    <?php 
        require_once "banco.php";

        $q = "SELECT * FROM livros";
        $busca = $banco->query($q);

        if ($busca->num_rows > 0) {
    ?>

    <table style="width: 50%;">
        <tr>
            <th>CODIGO</th>
            <th>TITULO</th>
            <th>AUTOR</th>
            <th>GENERO</th>
            <th>ANO PUBLICAÇÃO</th>
            <th>QUANTIDADE</th>
            <th>AÇÕES</th>
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
                    echo "<a href=\"editar.php?p=" . $obj_livro->id . "\"><button>Editar</button></a> ";
                    echo "<a href=\"remover.php?p=" . $obj_livro->id . "\" onclick=\"return confirm('Tem certeza que deseja remover este livro?');\"><button>Remover</button></a>";
                }
               
                echo "</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <?php 
        } else {
            echo "<p>Nenhum livro encontrado.</p>";
        }
    ?>
</body>
</html>
