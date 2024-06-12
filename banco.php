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
    
    function emprestar($nomeUsuario, $id_livro):bool{
        global $banco;

        $q = "SELECT id FROM usuarios WHERE usuario='$nomeUsuario'";
        $id_usuario = $banco->query($q)->fetch_object()->id;
        
        $q = "SELECT quantidade FROM livros WHERE id='$id_livro'";
        $quantidade = $banco->query($q)->fetch_object()->quantidade;

        if($quantidade > 0){ 
            $quantidade --;

            $q = "SELECT id FROM emprestimos WHERE id_livro='$id_livro' AND id_usuario='$id_usuario' AND status != 'devolvido'";
            $busca = $banco->query($q);

            if($busca->num_rows == 0){
                $data_emprestimo = date('Y-m-d');
                $data_prevista_devolucao = date('Y-m-d', strtotime($data_emprestimo. ' + 14 days'));
        
                $q = "INSERT INTO emprestimos (id_usuario, id_livro, data_emprestimo, data_prevista_devolucao) VALUES ('$id_usuario', '$id_livro', '$data_emprestimo', '$data_prevista_devolucao')";
        
                if ($banco->query($q) == true) {
                    $q = "UPDATE livros SET quantidade = '$quantidade' WHERE id = '$id_livro'";
                    $banco->query($q);
        
                    echo "<script>alert('Empréstimo registrado com sucesso')</script>";
                    return true;
                } else {
                    echo "Erro: " . $q . "<br>" . $banco->error;
                    return false;
                }
            }else{
                echo "<script>alert('Não foi possivel realizar emprestimo! O usuario já possui esse livro emprestado!')</script>";
                return false;
            }

            
        }else{
            echo "<script>alert('Não foi possivel realizar emprestimo! Não possui o livro pra emprestar!')</script>";
            return false;
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
