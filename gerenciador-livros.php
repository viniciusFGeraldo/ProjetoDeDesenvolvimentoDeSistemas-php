<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="submit" value="Adicionar livro">
    <input type="submit" value="Editar Livro">
    <input type="submit" value="Remover Livro">
    
    <?php 
    
        require_once "banco.php";

        $q = "SELECT * FROM livros";
        $busca = $banco->query($q);
        echo print_r($busca);
    ?>

    <table style="width: 50%;">
        <tr>
            <th>CODIGO</th>
            <th>TITULO</th>
            <th>AUTOR</th>
            <th>GENERO</th>
            <th>ANO PUBLICAÇÃO</th>
            <th>QUANTIDADE</th>
            <th></th>
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

                echo "<td><a href=\"editar.php?p=" . $obj_livro->id . "\">editar</a> </td>";
                echo "<td><a href=\"remover.php?p=" . $obj_livro->id . "\">remover</a> </td>";
                echo "</tr>";
            }
        ?>

    </table>
</body>
</html>