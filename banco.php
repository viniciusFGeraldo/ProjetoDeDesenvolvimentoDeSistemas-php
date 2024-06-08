<?php 

    $banco = new mysqli("localhost", "root", "", "biblioteca");

    if ($banco->connect_error) {
        die("Conexão falhou: " . $banco->connect_error);
    }

    function criarUsuario($nomeCompleto, $nomeUsuario, $email, $senha) {
        global $banco;

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $q = "INSERT INTO usuarios (id, nome, usuario, email, senha, senhaHash, isAdmin) VALUES (NULL, '$nomeCompleto', '$nomeUsuario', '$email', '$senha', '$senhaHash', default)";
        $resp = $banco->prepare($q);

        if ($resp) {
            $incluir = $resp->execute();
            if ($incluir) {
                echo "Novo usuário criado com sucesso.";
            } else {
                echo "Erro ao cadastrar usuário, tente novamente.";
            }

            $resp->close();
        } else {
            echo "Erro na preparação da consulta: " . $banco->error;
        }
    }

    function buscarUsuario($nomeUsuario){
        global $banco;

        $q = "SELECT nome,senha,senhaHash FROM usuarios WHERE usuario='$nomeUsuario'";
        $busca = $banco->query($q);

        return $busca;
    }
    
    function emprestar($id_usuario, $id_livro) {
        global $banco;

        $data_emprestimo = date('Y-m-d');
        $data_prevista_devolucao = date('Y-m-d', strtotime($data_emprestimo. ' + 14 days'));

        $q = "INSERT INTO emprestimos (id_usuario, id_livro, data_emprestimo, data_prevista_devolucao) VALUES ('$id_usuario', '$id_livro', '$data_emprestimo', '$data_prevista_devolucao')";

        if ($banco->query($q) === TRUE) {
            echo "<script>alert('Empréstimo registrado com sucesso')</script>";
        } else {
            echo "Erro: " . $q . "<br>" . $banco->error;
        }
    }

    function isAdmin($nomeUsuario):bool{
        global $banco;

        $q = "SELECT isAdmin FROM usuarios WHERE  usuario='$nomeUsuario'";
        $busca = $banco->query($q);

        if($busca->fetch_object()->isAdmin == 1){
            return true;
        }else{
            return false;
        }
        
    }
?>
