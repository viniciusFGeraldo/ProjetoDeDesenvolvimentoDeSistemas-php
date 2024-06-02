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
        header("Location: gerenciador-livros.php");
        exit();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
?>
