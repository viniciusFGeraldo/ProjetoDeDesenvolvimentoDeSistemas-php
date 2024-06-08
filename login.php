<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{
            background-color: #F2F2F2;
        }      
        .btn-grad {
            background-image: linear-gradient(to right, #fc00ff 0%, #00dbde  51%, #fc00ff  100%);
            margin: 10px;
            padding: 10px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
            border-radius: 10px;
        }
        .btn-grad:hover {
            background-position: right center;
            color: #fff;
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #000;
            border-radius: 0;
            box-shadow: none;
            padding-left: 0;
            padding-right: 0;
        }
        .form-control:focus {
            border-bottom-color: #007bff;
            box-shadow: none;
            outline: none;
        }
        .create-account-link {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .create-account-link:hover {
            background-color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }
        .create-account-link:active {
            background-color: #003d80;
            transform: translateY(0);
        }

    </style>
</head>
<body>
    <div class="container col-md-4">
        <form action="" method="post" class="mt-5 p-4 bg-white border rounded">
            <fieldset>
                <legend class="text-center mb-4">Bem - Vindo</legend>
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

        require_once "banco.php";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            $usuario = $_POST['usuario'] ?? null;
            $senha = $_POST['senha'] ?? null;
        
            if($usuario && $senha){
                $busca = buscarUsuario($usuario);
                $obj = $busca->fetch_object();
        
                if($busca->num_rows == 0){
                    echo "Usuário não existe.";
                }else{
                    
                    if(password_verify($senha, $obj->senhaHash)){
                        $_SESSION['usuario'] = $usuario;
                        echo "entrou com sucesso.";
                        header("Location: emprestimo.php");
                    }else{
                        echo "Senha incooreta..";
                    }
                }
            }
        }
    ?>

    </pre>
</body>
</html>

