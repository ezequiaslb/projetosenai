<?php
session_start();
include 'conecta.php';

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Preparar a consulta SQL para buscar o usuário no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = ?";

    // Preparar a declaração SQL
    $stmt = mysqli_prepare($conexao, $sql);

    // Vincular parâmetros
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Executar a declaração SQL
    mysqli_stmt_execute($stmt);

    // Obter o resultado da consulta
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar se a consulta retornou algum resultado
    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $usuario['senha'])) {
            // Senha está correta, fazer o login
        if ($usuario['tipo_usuario'] == 1) {
            $_SESSION['admin'] = true;
            header('Location: painel_adm.php');
        } else {
            $_SESSION['admin'] = false;
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
            $_SESSION['mensagem'] = 'Usuário não encontrado. Verifique suas informações de Login';
            header('Location: index.php');
        }

        // Liberar recursos
        mysqli_stmt_close($stmt);
        mysqli_close($conexao);
} else {
    // Não foram fornecidas  credenciais, redirecionar para a página de login
    header('Location: index.php');
}
?>
