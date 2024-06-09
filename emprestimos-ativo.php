<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos Ativos</title>
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
<h2 class="titulo">Empréstimos Ativos: </h2>
<div class="container-table">
    <table>
        <tr>
            <th>Código</th>
            <th>Usuário</th>
            <th>Livro</th>
            <th>Data de Empréstimo</th>
            <th>Data Prevista para Devolução</th>
            <th>Devolver</th>
        </tr>
        <?php
        $q = "SELECT e.id, u.usuario, l.titulo, e.data_emprestimo, e.data_prevista_devolucao
                FROM emprestimos e
                JOIN usuarios u ON e.id_usuario = u.id
                JOIN livros l ON e.id_livro = l.id
                WHERE e.status = 'emprestado'";
        $resultado = $banco->query($q);
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['usuario'] . "</td>
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
            echo "<tr><td colspan='6' class='mensagem'>Nenhum empréstimo foi realizado.</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>

