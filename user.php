<?php
session_start();

// Verificar se o usuário está logado como admin ou usuário padrão
if(!isset($_SESSION['admin']) || $_SESSION['admin']) {
    // Redireciona para a página de login se não estiver logado como usuário padrão
    header('Location: index.php');
    exit();
}

// Incluir o arquivo de conexão com o banco de dados
include 'conecta.php';

if (isset($usuario['id'])) {
    $id_usuario = $usuario['id'];
 } else {
    // faça algo caso o índice não esteja definido, como redirecionar o usuário para uma página de erro
    echo "Deu erro filha da puta";
 }
// Definir a variável id_usuario com o id do usuário logado
$id_usuario = $_SESSION['id'];

// Selecionar as reservas do usuário a partir do id do usuário logado
$sql = "SELECT r.id, r.data, r.hora_inicio, r.hora_fim, r.descricao, e.nome AS espaco, eq.nome AS equipamento FROM reservas r LEFT JOIN espacos e ON r.espaco_id = e.id LEFT JOIN equipamentos eq ON r.equipamento_id = eq.id WHERE r.usuario_id = $id_usuario ORDER BY r.data, r.hora_inicio";

$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de Reservas - Usuário</title>
</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="fazer_reserva.php">Fazer Reserva</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Minhas Reservas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Início</th>
                        <th>Fim</th>
                        <th>Descrição</th>
                        <th>Espaço</th>
                        <th>Equipamento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($reserva = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?= $reserva['data'] ?></td>
                        <td><?= $reserva['hora_inicio'] ?></td>
                        <td><?= $reserva['hora_fim'] ?></td>
                        <td><?= $reserva['descricao'] ?></td>
                        <td><?= $reserva['espaco'] ?></td>
                        <td><?= $reserva['equipamento'] ?></td>
                        <td><a href="excluir_reserva.php?id=<?= $reserva['id'] ?>">Excluir</a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?> 