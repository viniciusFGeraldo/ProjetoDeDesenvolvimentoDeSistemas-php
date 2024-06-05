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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['emprestar'])) {
        $id_usuario = $_POST['id_usuario'];
        $id_livro = $_POST['id_livro'];
        $data_emprestimo = date('Y-m-d');
        $data_prevista_devolucao = date('Y-m-d', strtotime($data_emprestimo. ' + 14 days'));

        $q = "INSERT INTO emprestimos (id_usuario, id_livro, data_emprestimo, data_prevista_devolucao) VALUES ('$id_usuario', '$id_livro', '$data_emprestimo', '$data_prevista_devolucao')";

        if ($banco->query($q) === TRUE) {
            echo "Empréstimo registrado com sucesso";
        } else {
            echo "Erro: " . $q . "<br>" . $banco->error;
        }
    }
    ?>
    <form method="post">
        <label for="id_usuario">Usuário:</label>
        <select name="id_usuario" required>
            <?php
            $q = "SELECT id, nomeUsuario FROM usuarios";
            $resultado = $banco->query($q);
            while($row = $resultado->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['nomeUsuario'] . "</option>";
            }
            ?>
        </select><br>
        <label for="id_livro">Livro:</label>
        <select name="id_livro" required>
            <?php
            $q = "SELECT id, titulo FROM livros";
            $resultado = $banco->query($q);
            while($row = $resultado->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['titulo'] . "</option>";
            }
            ?>
        </select><br>
        <input type="submit" name="emprestar" value="Registrar Empréstimo">
    </form>
</body>
</html>
