<?php
include 'conecta.php';
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo_usuario = $_POST['tipo_usuario'];

    $sql = "INSERT INTO usuarios (nome, email, telefone, senha, tipo_usuario) VALUES ('$nome', '$email', '$telefone', '$senha', $tipo_usuario)";

    if (mysqli_query($conexao, $sql)) {
        header('Location: gerenciar_usuarios.php?mensagem=sucesso');
    } else {
        header('Location: gerenciar_usuarios.php?mensagem=erro');
    }
}
?>