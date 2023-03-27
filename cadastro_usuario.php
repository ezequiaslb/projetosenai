<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de Usuários</title>
</head>
<body >
<div class="header">
            <h1>Sistema de Reservas</h1>
            <nav>
                <ul>
                    <li class="active"><a href="login.php">Início</a></li>
                    <li><a href="espacos.php">Espaços</a></li>
                    <li><a href="equipamentos.php">Equipamentos</a></li>
                    <li><a href="reservas.php">Reservas</a></li>
                    <li><a href="cadastro_usuario.php">Usuários</a></li>
                    <li><a href="sair.php">Sair</a></li>
                </ul>
            </nav>
        </div>

    <div class="container">
        <h1>Cadastro de Usuários</h1>

        <form  action="processa_cadastro_usuario.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone"><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>

            <label for="confirmar_senha">Confirmar senha:</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" required><br>

            <input type="submit" value="Cadastrar">
    </div>
</form>
</body>
</html>