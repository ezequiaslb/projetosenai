<?php 
if (!isset($_SESSION['cadastro_sucesso']) || $_SESSION['cadastro_sucesso'] !== true) {
    header("Location: admin.php");
    exit();
}
?>
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
                    <li class="active"><a href="index.php">Início</a></li>
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

        <form method="POST" action="processa_cadastro_usuario.php">
	<label for="nome">Nome:</label>
	<input type="text" id="nome" name="nome" required>

	<label for="email">E-mail:</label>
	<input type="email" id="email" name="email" required>

	<label for="telefone">Telefone:</label>
	<input type="text" id="telefone" name="telefone">

	<label for="senha">Senha:</label>
	<input type="password" id="senha" name="senha" required>

	<label for="tipo_usuario">Tipo de Usuário:</label>
	<select id="tipo_usuario" name="tipo_usuario">
		<option value="1">Administrador</option>
		<option value="2" selected>Usuário Padrão</option>
	</select>

	<input type="submit" value="Cadastrar">
    </form>
</div>

</body>
</html>