<?php 

    $banco = new mysqli("localhost", "root", "", "biblioteca");

    if ($banco->connect_error) {
        die("Conexão falhou: " . $banco->connect_error);
    }

    function criarUsuario($nomeUsuario, $senha) {
        global $banco;

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $q = "INSERT INTO usuarios (id, nomeUsuario, senha, senhaHash, isAdmin) VALUES (NULL, '$nomeUsuario', '$senha', '$senhaHash', default)";
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

        $q = "SELECT nomeUsuario,senha,senhaHash FROM usuarios WHERE nomeUsuario='$nomeUsuario'";
        $busca = $banco->query($q);

        return $busca;
    }

?>
