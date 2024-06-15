<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style-criarConta.css">
</head>
<body>
    <img src="./img/img1criar.png" alt="imagem de fundo" class="img-crianca">
    <div class="container col-md-5">
                
                <form action="" method="post" class="mt-3 p-4 bg-white border rounded">
                    <div style="width: auto;">
                        <button class="btn btn-danger d-flex flex-row align-items-center justify-content-center mb-4" type="button" onclick="login()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16" style="color: white" >
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0m3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/>
                            </svg>
                            <div style="margin-left: 10px;"></div>
                                Voltar
                        </button>
                    </div>

                    <div class="container">
                        <legend class="">Criar Conta</legend>
                        <img src="./img/logoBranca.jpg" alt="logo com fundo branco" class="logo">
                    </div>
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
                    <div class="text-center">
                        <input type="submit" value="Criar" class="btn btn-primary w-50">
                    </div>
                </form>
    </div>

    <?php 
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "banco.php";
            $nomeCompleto = $_POST['nome'] ?? null;
            $nomeUsuario = $_POST['usuario'] ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;
            if ($nomeCompleto && $nomeUsuario && $email && $senha) {
                criarUsuario($nomeCompleto, $nomeUsuario, $email, $senha);
                echo "<script>alert('Cadastro realizado com sucesso :) ')</script>";
                echo "<script>window.location.href = 'login.php';</script>";
                exit;
            }
        }
    ?>
</body>

<script>
    function login() {
        window.location.href = "./login.php";
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
