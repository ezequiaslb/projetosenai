<?php
include 'conecta.php';
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header('Location: index.php');
}

// Selecionar todas as reservas do banco de dados
$sql = "SELECT * FROM reservas ORDER BY data_inicio DESC";
$resultado = mysqli_query($conexao, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Painel Administrativo</title>
    
</head>
<body>
    <header>
    <h1>Sistema de Reservas</h1>
        
            <ul>
                <li><a href="gerenciar_usuarios.php">Usuários</a></li>
                <li><a href="gerenciar_espacos.php">Espaços</a></li>
                <li><a href="gerenciar_equipamentos.php">Equipamentos</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        
    </header>
    <main>
        <h2>Lista de Reservas</h2>
        <table>
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Data de início</th>
                    <th>Data de término</th>
                    <th>Espaço</th>
                    <th>Equipamento</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reserva = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?= $reserva['usuario'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($reserva['data_inicio'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($reserva['data_termino'])) ?></td>
                        <td><?= $reserva['espaco'] ?></td>
                        <td><?= $reserva['equipamento'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>