<?php
session_start();

// Inclui o arquivo de conexão com o banco de dados
include('conecta.php');

// Verifica se o usuário está logado como usuário padrão
if(!isset($_SESSION['admin']) || $_SESSION['admin']) {
    // Redireciona para a página de login se não estiver logado como usuário padrão
    header('Location: index.php');
    exit();
}

// Busca as reservas do usuário atual no banco de dados
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT r.id, r.data, r.hora_inicio, r.hora_fim, r.equipamento, r.espaco, r.status, e.nome AS equipamento_nome, es.nome AS espaco_nome FROM reservas r
        LEFT JOIN equipamentos e ON r.equipamento = e.id
        LEFT JOIN espacos es ON r.espaco = es.id
        WHERE r.usuario = $id_usuario";
$resultado = mysqli_query($conexao, $sql);

// Cria um array associativo para os status das reservas
$status_reservas = array(
    'P' => 'Pendente',
    'C' => 'Confirmada',
    'X' => 'Cancelada'
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuário - Sistema de Reservas</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="user.php" class="active">Reservas</a></li>
                    <li><a href="fazer_reserva.php">Fazer Reserva</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h1>Suas Reservas</h1>

        <?php if(mysqli_num_rows($resultado) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Equipamento/Espaço</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($reserva = mysqli_fetch_assoc($resultado)): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($reserva['data'])) ?></td>
                            <td><?= $reserva['hora_inicio'] ?> - <?= $reserva['hora_fim'] ?></td>
                            <td>
                                <?php if(!empty($reserva['equipamento_nome'])): ?>
                                    <?= $reserva['equipamento_nome'] ?>
                                <?php else: ?>
                                    <?= $reserva['espaco_nome'] ?>
                                <?php endif; ?>
                            </td>
                            <td><?= $status_reservas[$reserva['status']] ?></td>
                            <td>
                                <?php if($reserva['status'] == 'P'): ?>
                                    <a href="excluir_reserva.php?id=<?= $reserva['id'] ?>">Cancelar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma reserva encontrada.</p>
        <?php endif; ?>
    </div>
</body>    