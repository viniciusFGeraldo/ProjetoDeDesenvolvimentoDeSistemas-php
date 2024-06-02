<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Livros</title>
</head>
<body>

    <h2>Adicionar Livro</h2>
    <form action="adicionar.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required>
        <br>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" required>
        <br>
        <label for="genero">Gênero:</label>
        <input type="text" name="genero" required>
        <br>
        <label for="ano_publicacao">Ano de Publicação:</label>
        <input type="number" name="ano_publicacao" required>
        <br>
        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required>
        <br>
        <input type="submit" value="Adicionar Livro">
    </form>
    

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
                echo "<a href=\"editar.php?p=" . $obj_livro->id . "\">Editar</a> ";
                echo "<a href=\"remover.php?p=" . $obj_livro->id . "\" onclick=\"return confirm('Tem certeza que deseja remover este livro?');\">Remover</a>";
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
