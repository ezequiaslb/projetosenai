<?php 
// Inicia a sessão para verificar se o usuário está autenticado e se é um administrador
session_start();
if(!isset($_SESSION['id_usuario'])) {
	// Redireciona o usuário para a página de login
	header("Location: login.php");
}
    require_once "conecta.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Página e Administração</title>
</head>
<body class="container2">
<h1>Bem-vindo, <?php echo $_SESSION['nome_usuario']; ?>!</h1>
    <nav>
        <ul>
            <li><a href="gerencia_usuarios.php">Gerenciar Usuários</a></li>
            <li><a href="gerencia_espacos.php">Gerenciar Espaços</a></li>
            <li><a href="gerencia_reservas.php">Gerenciar Reservas</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</body>
</html>