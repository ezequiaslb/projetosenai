<?php 
// Inicia a sessão para verificar se o usuário está autenticado e se é um administrador
session_start();
if(!isset($_SESSION['id_usuario'])) {
	// Redireciona o usuário para a página de login
	header("Location: login.php");
} 
include_once "conecta.php";

// Recebe os dados do formulário de cadastro
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$tipo_usuario = $_POST['tipo_usuario'];

// Valida os dados recebidos
if(empty($nome) || empty($email) || empty($senha)) {
    header("Location: cadastro_usuario.php?erro=1");
    exit();
}

// Verifica se o e-mail já está cadastrado
$sql = "SELECT id FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultado) > 0) {
    header("Location: cadastro_usuario.php?erro=2");
    exit();
}

// Insere o novo registro na tabela de usuários
$sql = "INSERT INTO usuarios (nome, email, telefone, senha, tipo_usuario) VALUES ('$nome', '$email', '$telefone', '$senha', $tipo_usuario)";

// Define a variável de sessão 'cadastro_sucesso' como true
$_SESSION['cadastro_sucesso'] = true;

// Redireciona o usuário para a página de cadastro
header("Location: cadastro_usuario.php");

if(mysqli_query($conexao, $sql)) {
    header("Location: cadastro_usuario.php?msg=cadastro_sucesso");
    exit();
} else {
    header("Location: cadastro_usuario.php?erro=3");
    exit();
}


?>