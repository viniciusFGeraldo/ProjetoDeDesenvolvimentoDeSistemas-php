<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos Ativos</title>
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
            echo "<a href='emprestimos-ativo.php' class='nav-link'><button class='btn'>Empréstimos Ativos</button></a>";
            echo "<a href='emprestimos-ativo-usuario.php' class='nav-link'><button class='btn'>Empréstimos Ativos Ativos do Admin</button></a>";
            echo "<a href='logout.php' class='nav-link'><button class='btn btn-danger' style='width: 80px;'>Sair</button></a>";
            echo "</nav>";
        }else{
            echo "<nav class='header-nav'>";
            echo "<a href='emprestimo.php'><img src='./img/logo.jpg' alt='logo fundo cinza' class='logo'></a>";
            echo "<a href='emprestimos-ativo-usuario.php' class='nav-link'><button class='btn'>Empréstimos Ativos</button></a>";
            echo "<a href='logout.php' class='nav-link'><button class='btn btn-danger'>Sair</button></a>";
            echo "</nav>";
        }
    }

    if (isset($_GET['id_emprestimo'])) {
        $id_emprestimo = $_GET['id_emprestimo'];
        $data_devolucao = date('Y-m-d');

        $q = "  SELECT id_livro FROM emprestimos WHERE id='$id_emprestimo'";
        $id_livro = $banco->query($q)->fetch_object()->id_livro;

        $q = "SELECT quantidade FROM livros WHERE id='$id_livro'";
        $quantidade = $banco->query($q)->fetch_object()->quantidade;
        $quantidade ++;

        $q = "UPDATE livros SET quantidade = '$quantidade' WHERE id = '$id_livro'";
        $banco->query($q);

        $q = "UPDATE emprestimos SET data_devolucao='$data_devolucao', status='devolvido' WHERE id='$id_emprestimo'";

        if ($banco->query($q) === TRUE) {
            echo "Livro devolvido com sucesso";
        } else {
            echo "Erro: " . $q . "<br>" . $banco->error;
        }
        header("Location: emprestimos-ativo-usuario.php");
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
        $usu = $_SESSION["usuario"];

        $q = "SELECT id FROM usuarios WHERE usuario = '$usu'";
        $id_usuario = $banco->query($q)->fetch_object()->id;

        $q = "SELECT e.id, u.usuario, l.titulo, e.data_emprestimo, e.data_prevista_devolucao
                FROM emprestimos e
                JOIN usuarios u ON e.id_usuario = u.id
                JOIN livros l ON e.id_livro = l.id
                WHERE e.status = 'emprestado' AND e.id_usuario = '$id_usuario'";

        $resultado = $banco->query($q);
        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                $dataEmprestimo = new DateTime($row['data_emprestimo']);
                $dataPrevisao = new DateTime($row['data_prevista_devolucao']);

                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['usuario'] . "</td>
                        <td>" . $row['titulo'] . "</td>
                        <td>" . $dataEmprestimo->format("d/m/Y") . "</td>
                        <td>" . $dataPrevisao->format("d/m/Y") . "</td>
                        <td>
                            <a href='emprestimos-ativo-usuario.php?id_emprestimo=".$row['id']."'><button>Devolver</button></a>
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

