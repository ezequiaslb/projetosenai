<?php
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtém os valores dos campos do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];
    $tipo_usuario = $_POST["tipo_usuario"];

    // Validação do formulário
    $errors = array();
    if (empty($nome)) {
        $errors[] = "O campo nome é obrigatório.";
    }
    if (empty($email)) {
        $errors[] = "O campo e-mail é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "O campo e-mail não é válido.";
    }
    if (empty($senha)) {
        $errors[] = "O campo senha é obrigatório.";
    }

    // Se houver erros, exibe-os e para o processamento
    if (count($errors) > 0) {
        echo "<p>Por favor, corrija os seguintes erros:</p>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
        // Conecta ao banco de dados usando a página "conecta.php"
        include("conecta.php");

        // Insere o novo usuário na tabela "usuarios"
        $hashed_password = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, telefone, senha, tipo_usuario) VALUES ('$nome', '$email', '$telefone', '$hashed_password', '$tipo_usuario')";

        // Executar a consulta SQL
        if (mysqli_query($conexao, $sql)) {
            $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
            header("Location: cadastro_usuario.php");
        } else {
            $_SESSION['mensagem'] = "Erro ao cadastrar usuário: " . mysqli_error($conexao);
            header("Location: cadastro_usuario.php");
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conexao);
    }
} else {
    // Se o formulário não foi submetido, redireciona o usuário para a página de cadastro
    header("Location: cadastro_usuario.php");
    exit;
}
