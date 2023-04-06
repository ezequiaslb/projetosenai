<?php
include 'conecta.php';
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header('Location: index.php');
}

// Verifica se algum usuário foi excluído
if (isset($_GET['excluido']) && $_GET['excluido'] == true) {
    echo '<p class="sucesso">Usuário excluído com sucesso!</p>';
}

// Selecionar todos os usuários do banco de dados
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="painel_adm.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="painel_adm.php">Sistema de Reservas</a>
        </div>
        <nav>
            <ul>
                <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
                <li><a href="gerenciar_espacos.php">Gerenciar Espaços</a></li>
                <li><a href="gerenciar_equipamentos.php">Gerenciar Equipamentos</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Gerenciar Usuários</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?= $usuario['nome'] ?></td>
                        <td><?= $usuario['email'] ?></td>
                        <td>
                            <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="botao-editar">Editar</a>
                            <a href="excluir_usuario.php?id=<?= $usuario['id'] ?>" class="botao-excluir" onclick="return confirm('Tem certeza que deseja excluir o usuário <?= $usuario['nome'] ?>?')">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <h3>Cadastrar novo usuário</h3>
        <form action="cadastrar_usuario.php" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </main>
</body>
</html>