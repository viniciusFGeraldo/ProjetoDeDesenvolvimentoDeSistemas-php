<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style-login.css">
</head>
<body>
    <div class="container col-md-4">
        <form action="" method="post" class="mt-5 p-4 bg-white border rounded">
            <fieldset>
                <legend class="text-center mb-4">Bem - Vindo</legend>
                <div class="logo-container">
                    <img src="./img/logoBranca.jpg" alt=" logo fundo branco" class="logo">
                </div>
                <div class="form-group mb-4">
                    <label for="usuario">Usuário: </label>
                    <input type="text" class="form-control" name="usuario" id="usuario" required>
                </div>
                <div class="form-group mb-4">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" name="senha" id="senha" required>
                </div>
                <div class="text-center">
                    <a href="./criar-conta.php" class="d-block mb-3 create-account-link">Criar Conta</a>
                    <input type="submit" value="Entrar" class="btn btn-primary btn-grad">
                    
                </div>
            </fieldset>
        </form>
    </div>
    <pre>

    <?php 

        session_start();

        if(isset($_SESSION["usuario"])){
            header("Location: emprestimo.php");
        }

        require_once "banco.php";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $usuario = $_POST['usuario'] ?? null;
            $senha = $_POST['senha'] ?? null;
        
            if($usuario && $senha){
                $busca = buscarUsuario($usuario);
                $obj = $busca->fetch_object();
        
                if($busca->num_rows == 0){
                    echo "<script>alert('Usuario Não existe')</script>";
                }else{
                    
                    if(password_verify($senha, $obj->senhaHash)){
                        $_SESSION['usuario'] = $usuario;
                        echo "entrou com sucesso.";
                        header("Location: emprestimo.php");
                    }else{
                        echo "<script>alert('Senha incorreta...')</script>";
                    }
                }
            }
        }
    ?>

    </pre>
</body>
</html>

