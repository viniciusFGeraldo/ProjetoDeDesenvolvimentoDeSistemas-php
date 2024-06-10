<?php
session_start();
$usu = $_SESSION["usuario"] ?? null;

if (is_null($usu)) {
    header("Location:login.php");
    exit();
}

$cod = $_GET["p"] ?? null;

if (is_null($cod)) {
    echo "Nenhum livro para remover";
    exit();
}

require_once "banco.php";

$q = "DELETE FROM emprestimos WHERE id_livro='$cod'";
$banco->query($q);
$q = "DELETE FROM livros WHERE id='$cod'";
$banco->query($q);

header("Location: emprestimo.php");
exit();
?>
