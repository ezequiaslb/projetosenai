<?php
session_start();

// Definir as variáveis para conexão com o banco de dados
$hostname = "localhost";   // Endereço do servidor de banco de dados
$username = "ezequias"; // Nome do usuário do banco de dados
$password = "[SYLlmSDrngBRroi";   // Senha do usuário do banco de dados
$dbname   = "sistemareservas";  // Nome do banco de dados

// Conectar ao banco de dados usando a função mysqli_connect()
$conexao = mysqli_connect($hostname, $username, $password, $dbname);

// Verificar se houve erros na conexão
if (mysqli_connect_errno()) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}

// Receber os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Preparar a consulta SQL para buscar o usuário no banco de dados
$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

// Executar a consulta SQL
$resultado = mysqli_query($conexao, $sql);

// Verificar se a consulta retornou algum resultado
if (mysqli_num_rows($resultado) > 0) {
    // O usuário foi encontrado, verificar se é um administrador ou não
    $usuario = mysqli_fetch_assoc($resultado);
    if ($usuario['tipo_usuario'] == 1) {
        // O usuário é um administrador, redirecionar para a página de administração
        $_SESSION['admin'] = true;
        header('Location: paineladm.php');
    } else {
        // O usuário é um usuário comum, redirecionar para a página de usuário
        $_SESSION['admin'] = false;
        header('Location: user.php');
    }
} else {
    // O usuário não foi encontrado, exibir mensagem de erro e redirecionar para a página de login
    $_SESSION['mensagem'] = 'E-mail ou senha incorretos';
    header('Location: index.php');
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>
