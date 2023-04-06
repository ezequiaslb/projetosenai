<?php
include 'conecta.php';

// verificar se o id do usuário foi passado pela URL
if (!isset($_GET['id'])) {
    header('Location: gerenciar_usuarios.php');
    exit();
}

// obter o id do usuário da URL
$id = $_GET['id'];

// verificar se o usuário existe no banco de dados
$sql = "SELECT * FROM usuarios WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
if (mysqli_num_rows($resultado) == 0) {
    header('Location: gerenciar_usuarios.php');
    exit();
}

// excluir o usuário do banco de dados
$sql = "DELETE FROM usuarios WHERE id = $id";
if (mysqli_query($conexao, $sql)) {
    $mensagem = "Usuário excluído com sucesso.";
} else {
    $mensagem = "Erro ao excluir usuário: " . mysqli_error($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<main>
    <body>
        <h1>Excluir Usuário</h1>
        <p><?= $mensagem ?></p>
        <a href="gerenciar_usuarios.php">Voltar para a lista de usuários</a>
    </body>
</main>
</html>
