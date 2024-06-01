<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="titulo">Titulo: </label>
            <input type="text" name="titulo" id="titulo">
        </div>
        <div>
            <label for="autor">Autor: </label>
            <input type="text" name="autor" id="autor">
        </div>
        <div>
            <label for="genero">Genero: </label>
            <input type="text" name="genero" id="genero">
        </div>
        <div>
            <label for="ano">Ano de publicação: </label>
            <input type="date" id="year" name="year" pattern="\d{4}" oninput="this.value = this.value.slice(0, 4)">
        </div>
        <div>
            <label for="quantidade">Quant. de livros: </label>
            <input type="number" name="quantidade" id="quantidade">
        </div>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>