<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./style/styles.css">
</head>
<body>
    <form action="" method="post">
        <fieldset>

            <legend>Login</legend>
            <div>
                <label for="usuario">Usuário: </label>
                <input type="text" name="usuario" id="usuario">
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha">
            </div>
            <a href="./criar-conta.php">Criar Conta</a>
            <input type="submit" value="Entrar">
        </fieldset>
    </form>
    <pre>

    <?php 
        require_once "banco.php";

        $usuario = $_POST['usuario'] ?? null;
        $senha = $_POST['senha'] ?? null;
        
        if($usuario && $senha){
            $busca = buscarUsuario($usuario);

            if($busca->num_rows == 0){
                echo "Usuário não existe.";
            }else{
                $obj = $busca->fetch_object();

                if(password_verify($senha, $obj->senhaHash)){
                    header("Location: paginaDeCadastro.php");
                }else{
                    echo "Senha incooreta..";
                }
            }
        }
        

    ?>
    </pre>
</body>
</html>
