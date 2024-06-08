<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background-color: #F3F1F2;
        }
        .btn-danger{
            background-color: red;
            padding: 10px 40px;
        }
        .btn-danger:hover{
            background-color: #117f09;
            border-color: #117f09;
        }
        .img-crianca {
            position: absolute;
            object-fit: contain;
            width: 30vw;
            bottom: 0;
            max-width: 100%;
            height: auto;
        }
        @media (max-width: 770px){
            .img-crianca{
                display: none;
            }
        }

    </style>
</head>
<body>
    <img src="./img/img1criar.jpg" alt="imagem de fundo" class="img-crianca">
    <div class="container col-md-5">
                <form action="" method="post" class="mt-3 p-4 bg-white border rounded">
                    <legend class="text-center mb-2">Criar Conta</legend>
                    <div class="form-group mb-4">
                        <label for="nome">Nome Completo: </label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="usuario">Usuário: </label>
                        <input type="text" class="form-control" name="usuario" id="usuario" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="senha" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="confirmarSenha">Confirmar Senha:</label>
                        <input type="password" class="form-control" name="confirmarSenha" id="confirmarSenha" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Criar" class="btn btn-danger ">
                    </div>
                </form>
    </div>

    <?php 
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "banco.php";
            $nomeUsuario = $_POST['usuario'] ?? null;
            $senha = $_POST['senha'] ?? null;
            if ($nomeUsuario && $senha) {
                criarUsuario($nomeUsuario, $senha);
            }
        }
    ?>
</body>
</html>
