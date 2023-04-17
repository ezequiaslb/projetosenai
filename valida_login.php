<?php
session_start();
include 'conecta.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

// Preparar a consulta SQL para buscar o usuário no banco de dados
$sql = "SELECT * FROM usuarios WHERE email = '$email'";

// Executar a consulta SQL
$resultado = mysqli_query($conexao, $sql);

// Verificar se a consulta retornou algum resultado
if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);
    if (password_verify($senha, $usuario['senha'])) {
        // Senha está correta, fazer o login
        if ($usuario['tipo_usuario'] == 1) {
            $_SESSION['admin'] = true;
            header('Location: painel_adm.php');
        } else {
            // Armazenar o ID do usuário em uma variável
            $id_usuario = $usuario['id'];
            // Definir a variável de sessão "id_usuario" com o valor do ID do usuário
            $_SESSION['id_usuario'] = $id_usuario;
            header('Location: user.php');
        }
    } else {
        // Senha está incorreta, exibir mensagem de erro e redirecionar para a página de login
        $_SESSION['mensagem'] = 'E-mail ou senha incorretos';
        header('Location: index.php');
    }
} else {
    // Não encontrou usuário com esse e-mail, exibir mensagem de erro e redirecionar para a página de login
    $_SESSION['mensagem'] = 'E-mail ou senha incorretos';
    header('Location: index.php');
}
mysqli_close($conexao);
?>
