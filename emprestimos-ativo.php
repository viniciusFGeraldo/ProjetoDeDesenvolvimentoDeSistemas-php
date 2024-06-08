<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos Ativos</title>
</head>
<body>
<?php
    include 'banco.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['devolver'])) {
        $id_emprestimo = $_POST['id_emprestimo'];
        $data_devolucao = date('Y-m-d');

        $q = "UPDATE emprestimos SET data_devolucao='$data_devolucao', status='devolvido' WHERE id='$id_emprestimo'";

        if ($banco->query($q) === TRUE) {
            echo "Livro devolvido com sucesso";
        } else {
            echo "Erro: " . $q . "<br>" . $banco->error;
        }
    }
?>
<h2>Empréstimos Ativos</h2>
<table border="1">
    <tr>
        <th>ID Empréstimo</th>
        <th>Usuário</th>
        <th>Livro</th>
        <th>Data de Empréstimo</th>
        <th>Data Prevista para Devolução</th>
        <th>Devolver</th>
    </tr>
    <?php
    $q = "SELECT e.id, u.nomeUsuario, l.titulo, e.data_emprestimo, e.data_prevista_devolucao
            FROM emprestimos e
            JOIN usuarios u ON e.id_usuario = u.id
            JOIN livros l ON e.id_livro = l.id
            WHERE e.status = 'emprestado'";
    $resultado = $banco->query($q);
    if ($resultado->num_rows > 0) {
        while($row = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nomeUsuario'] . "</td>
                    <td>" . $row['titulo'] . "</td>
                    <td>" . $row['data_emprestimo'] . "</td>
                    <td>" . $row['data_prevista_devolucao'] . "</td>
                    <td>
                        <form method='post'>
                            <input type='hidden' name='id_emprestimo' value='" . $row['id'] . "'>
                            <input type='submit' name='devolver' value='Devolver'>
                        </form>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Nenhum empréstimo ativo encontrado</td></tr>";
    }
    ?>
</table>
</body>
</html>

