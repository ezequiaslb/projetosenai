<?php
session_start();

if(!isset($_SESSION['admin']) || $_SESSION['admin']) {
    // Redireciona para a página de login se não estiver logado como usuário padrão
    header('Location: index.php');
    exit();
}

// Inclui o arquivo de conexão com o banco de dados
include 'conecta.php';

// Seleciona todas as reservas do usuário atual
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT r.id, r.data, r.hora, r.observacoes, s.descricao AS sala_descricao FROM reservas r INNER JOIN salas s ON r.id_sala = s.id WHERE r.id_usuario = $id_usuario";
$resultado = mysqli_query($conexao, $sql);  

// Verifica se a consulta retornou algum resultado
if (mysqli_num_rows($resultado) > 0) {
    $reservas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
} else {
    $reservas = array();
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuário</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Minhas reservas</h1>

        <?php if (!empty($reservas)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Sala</th>
                        <th>Observações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td><?= $reserva['data'] ?></td>
                            <td><?= $reserva['hora'] ?></td>
                            <td><?= $reserva['sala_descricao'] ?></td>
                            <td><?= $reserva['observacoes'] ?></td>
                            <td><a href="excluir_reserva.php?id=<?= $reserva['id'] ?>">Excluir</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Você ainda não possui reservas.</p>
        <?php endif; ?>

        <a href="fazer_reserva.php">Fazer reserva</a>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>