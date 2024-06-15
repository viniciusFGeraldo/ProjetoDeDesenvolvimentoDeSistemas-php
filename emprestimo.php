<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo de livros</title>
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
            echo "<a href='emprestimos-ativo.php' class='nav-link'><button class='btn'>Emprestimos Ativos</button></a>";
            echo "<a href='emprestimos-ativo-usuario.php' class='nav-link'><button class='btn'>Empréstimos Ativos Ativos do Admin</button></a>";
            echo "<a href='logout.php' class='nav-link'><button class='btn btn-danger' style='width: 80px;'>Sair</button></a>";
            echo "</nav>";
        }else{
            echo "<nav class='header-nav'>";
            echo "<a href='emprestimo.php'><img src='./img/logo.jpg' alt='logo fundo cinza' class='logo'></a>";
            echo "<a href='emprestimos-ativo-usuario.php' class='nav-link'><button class='btn'>Emprestimos Ativos</button></a>";
            echo "<a href='logout.php' class='nav-link'><button class='btn btn-danger'>Sair</button></a>";
            echo "</nav>";
        }


        if (isset($_GET['idLivro'])) {
            $id_usuario = $_SESSION["usuario"];
            $id_livro = $_GET['idLivro'];
            emprestar($id_usuario, $id_livro);

            if(isAdmin($_SESSION["usuario"])){
                echo "<script>window.location.href = 'emprestimos-ativo.php';</script>";

            }else{
                echo "<script>window.location.href = 'emprestimos-ativo-usuario.php';</script>";
            }
        }
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
                $iconEditar = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                    <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z'/>
                    </svg>";

                $iconExcluir = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                </svg>";

                $iconEmprestar = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-plus-circle-fill' viewBox='0 0 16 16'>
                    <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z'/>
                </svg>";


                while ($obj_livro = $busca->fetch_object()) { 
                    echo "<tr>";
                    echo "<td>$obj_livro->id</td>";
                    echo "<td>$obj_livro->titulo</td>";
                    echo "<td>$obj_livro->autor</td>";
                    echo "<td>$obj_livro->genero</td>";
                    echo "<td>$obj_livro->ano_publicacao</td>";
                    echo "<td>$obj_livro->quantidade</td>";
                    
                    echo "<td  class='d-flex align-items-center justify-content-center'>";
                    
                    if (isAdmin($_SESSION["usuario"])) {
                        echo "<a href='emprestimo.php?idLivro=$obj_livro->id'>
                        <button class='btn d-flex align-items-center'>
                            $iconEmprestar  <p class='ml-2'></p> Emprestar
                        </button>
                    </a>";
                        echo "<a href=\"editar.php?p=" . $obj_livro->id . "\"><button class='btn edit ml-2'>$iconEditar</button></a> ";
                        echo "<a href=\"remover.php?p=" . $obj_livro->id . "\" onclick=\"return confirm('Tem certeza que deseja remover este livro?');\">
                        <button class='btn delete ml-1'>$iconExcluir</button></a>";
                    }else{
                        echo "<a href='emprestimo.php?idLivro=$obj_livro->id' class='d-flex align-items-center justify-content-center'>
                        <button class='btn d-flex align-items-center'>
                            $iconEmprestar  <p class='ml-2'></p> Emprestar
                        </button>
                        </a>";
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
