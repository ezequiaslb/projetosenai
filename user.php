<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas - Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Reservas</h1>
        <nav>
            <ul>
                <li><a href="user.php">Minhas Reservas</a></li>
                <li><a href="fazer_reserva.php">Fazer Reserva</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Minhas Reservas</h2>
        <table>
            <thead>
                <tr>
                    <th>Data de início</th>
                    <th>Data de término</th>
                    <th>Espaço</th>
                    <th>Equipamento</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'conecta.php';
                session_start();
                $id_usuario = $_SESSION['id_usuario'];
                $sql = "SELECT r.id, r.data_inicio, r.data_termino, e.nome AS espaco, q.nome AS equipamento, r.status FROM reservas r JOIN espacos e ON r.id_espaco = e.id
                LEFT JOIN equipamentos q ON r.id_equipamento = q.id
                        WHERE r.id_usuario = $id_usuario";
                $resultado = mysqli_query($conexao, $sql);
                while ($reserva = mysqli_fetch_assoc($resultado)) {
                    $status = $reserva['status'] == 1 ? 'Ativa' : 'Cancelada';
                ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($reserva['data_inicio'])) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($reserva['data_termino'])) ?></td>
                        <td><?= $reserva['espaco'] ?></td>
                        <td><?= $reserva['equipamento'] ?? '-' ?></td>
                        <td><?= $status ?></td>
                        <td>
                            <?php if ($reserva['status'] == 1 && strtotime($reserva['data_inicio']) > time()) { ?>
                                <form action="excluir_reserva.php" method="post">
                                    <input type="hidden" name="id_reserva" value="<?= $reserva['id'] ?>">
                                    <button type="submit">Excluir</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>