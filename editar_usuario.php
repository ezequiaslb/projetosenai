<?php
include 'conecta.php';
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header('Location: index.php');
}

// Verifica se o ID do usuário foi passado via GET
if (!isset($_GET['id'])) {
    header('Location: gerenciar_usuarios.php');
}

// Obtém os dados do usuário do banco de dados
$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
$usuario = mysqli_fetch_assoc($resultado);

// Verifica se o usuário existe
if (!$usuario) {
    header('Location: gerenciar_usuarios.php');
}

// Atualiza o usuário se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $tipo_usuario = $_POST['tipos_usuario'];

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', telefone = '$telefone', tipo_usuario = $tipo_usuario WHERE id = $id";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado) {
        header('Location: gerenciar_usuarios.php?mensagem=Usuário atualizado com sucesso!');
    } else {
        $erro = 'Erro ao atualizar usuário. Por favor, tente novamente.';
    }
}

    // Obtém os tipos de usuário do banco de dados
    $sql = "SELECT * FROM tipos_usuario";
    $resultado = mysqli_query($conexao, $sql);

    $tipos_usuario = array();

    while ($tipo = mysqli_fetch_assoc($resultado)) {
        $tipos_usuario[$tipo['id']] = $tipo['descricao'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sistema de Reservas</h1>
        <nav>
            <ul>
                <li><a href="painel_adm.php">Painel Administrativo</a></li>
                <li><a href="gerenciar_usuarios.php">Usuários</a></li>
                <li><a href="gerenciar_espacos.php">Espaços</a></li>
                <li><a href="gerenciar_equipamentos.php">Equipamentos</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Editar Usuário</h2>
        <?php if (isset($erro)) { ?>
            <div class="erro"><?= $erro ?></div>
        <?php } ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="<?= $usuario['nome'] ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= $usuario['email'] ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" name="telefone" id="telefone" value="<?= $usuario['telefone'] ?>">
            </div>
            <div class="form-group">
                <?php
                //$sql = "SELECT * FROM tipos_usuario";
                //$resultado = mysqli_query($conexao, $sql);

                // while ($tipo = mysqli_fetch_assoc($resultado)) {
                //     echo '<option value="' . $tipo['id'] . '"';
                //     if (isset($usuario['tipo_usuario']) && $usuario['tipo_usuario'] == $tipo['id']) {
                //         echo '';
                //     }
                //     echo '>' . $tipo['descricao'] . '</option>';
                //}
             ?>  
             
                <label for="tipos_usuario">Tipo de Usuário:</label>
                <select id="tipos_usuario" name="tipos_usuario">
                <option value="1" <?php if ($usuario['tipo_usuario'] == 1) echo 'selected' ?>>Administrador</option>
                <option value="2" <?php if ($usuario['tipo_usuario'] == 2) echo 'selected' ?>>Usuário Comum</option>
                </select>
            </div>
                <button type="submit">Salvar</button>
            </form>
        </main>

</body>
</html>




