<?php
include 'conecta.php';
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Espaços</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Reservas</h1>
        <nav>
            <ul>
                <li><a href="painel_adm.php">Painel Administrativo</a></li>
                <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
                <li><a href="gerenciar_espacos.php">Gerenciar Espaços</a></li>
                <li><a href="gerenciar_equipamentos.php">Gerenciar Equipamentos</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Gerenciar Espaços</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Capacidade</th>
                    <th>Localização</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <a class="editar-btn" href="cadastrar_espaco.php">Cadastrar novo espaço</a>
    </main>
</body>
</html>







