<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <legend>Criar Conta</legend>
        <div>
            <label for="usuario">Usuário: </label>
            <input type="text" name="usuario" id="usuario" required>
        </div>
        <div>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>
        </div>
        <input type="submit" value="Criar">
    </form>

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