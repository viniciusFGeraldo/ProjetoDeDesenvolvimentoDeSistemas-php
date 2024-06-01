# ProjetoDeDesenvolvimentoDeSistemas-php
projeto final de desenvolvimento de sistema com linguagem php


banco de dados-> 
    nome do banco = biblioteca

    tabela 1 ->
        nome da tabela = usuarios
            id - int - 20 - primary key marcado,
            nomeUsuario - varchar - 50,
            senha - varchar - 50,
            senhaHash - varchar - 100,
            isAdmin - tinyint(1) - padrão 0

    tabela 2 ->
        nome da tabela = livros
            id - int - 50 - primary key marcado,
            titulo - varchar - 100,
            autor - varchar - 100,
            genero - varchar - 100,
            ano_publicacao - year - 4,
            quantidade - int - 11 - padrão 1

    tabela 3 ->
        nome da tabela = emprestimos
            id - int - 50 - primary key marcado,
            id_usuario - int - 11,
            id_livro - int - 11,
            data_emprestimo - date,
            data_devolucao - date,
            data_prevista_devolucao - date,
            status - varchar - 50 - padrao emprestado