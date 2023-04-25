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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <H1>Sistema de Reservas</H1>
        </div>
        <nav>
            <ul>
                <li><a href="gerenciar_usuarios.php">Usuários</a></li>
                <li><a href="gerenciar_espacos.php">Espaços</a></li>
                <li><a href="gerenciar_equipamentos.php">Equipamentos</a></li>
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
                            <a href="editar_usuario.php?id=<?= $usuario['id'] ?>" class="editar-btn" >Editar</a>
                            <a href="excluir_usuario.php?id=<?= $usuario['id'] ?>" class="excluir-btn" onclick="return confirm('Tem certeza que deseja excluir o usuário <?= $usuario['nome'] ?>?')">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </main>
    
    <main>
    <h3>Cadastrar novo usuário</h3>
    <?php 
    // Verifica se existe mensagem na URL
    if (isset($_GET['mensagem'])) {
        $mensagem = $_GET['mensagem'];
        
        // Exibe a mensagem de acordo com o parâmetro passado na URL
        if ($mensagem == 'sucesso') {
            echo '<p class= sucesso>Cadastro realizado com sucesso!</p>';
        } else if ($mensagem == 'erro') {
            echo '<p class= erro>Erro ao cadastrar usuário.</p>';
        }
    }
    ?>
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
                <label for="itel">Senha:</label>
                <input type="tel" name="telefone" id="itel" required>
            </div>
            <div class="form-group">
                <label for="senha">Telefone:</label>
                <input type="password" name="senha" id="senha" required>
            </div>
            <div>
                <label for="tipo_usuario">Tipo de Usuário:</label>
                <select id="tipo_usuario" name="tipo_usuario">
                <option value="1">Administrador</option>
                <option value="2" selected>Usuário Padrão</option>
                </select>
            </div>
            <button type="submit">Cadastrar</button>
        </form> 
    </main>
</body>
</html>