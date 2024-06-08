<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post" class="mt-5 p-4 bg-white border rounded">
                    <legend class="text-center mb-4">Criar Conta</legend>
                    <div class="form-group">
                        <label for="usuario">Usuário: </label>
                        <input type="text" class="form-control" name="usuario" id="usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="senha" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Criar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php 
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once "banco.php";
            $nomeUsuario = $_POST['usuario'] ?? null;
            $senha = $_POST['senha'] ?? null;
            if ($nomeUsuario && $senha) {
                criarUsuario($nomeUsuario, $senha);
            } else {
                echo "Por favor, preencha todos os campos.";
            }
        }
    ?>
</body>
</html>
