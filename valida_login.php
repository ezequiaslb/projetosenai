<?php
// Inicia a sessão para armazenar informações do usuário temporariamente
session_start();

// Inclui o arquivo de conexão com o banco de dados
require_once "conecta.php";

// Verifica se as variáveis de email e senha foram enviadas pelo formulário de login
if(isset($_POST['email']) && isset($_POST['senha'])) {
    // Armazena as variáveis de email e senha em variáveis locais
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    // Monta a consulta SQL para buscar o registro do usuário no banco de dados
    $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    
    // Executa a consulta SQL no banco de dados
    $result = mysqli_query($conexao, $query);

    // Verifica se a consulta retornou apenas um registro
    if(mysqli_num_rows($result) == 1) {
        // Armazena os dados do usuário na sessão para uso em outras páginas
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_usuario'] = $row['id'];
        $_SESSION['nome_usuario'] = $row['nome'];
        $_SESSION['tipo_usuario'] = $row['tipo'];

        // Redireciona o usuário para a página correta de acordo com seu tipo de usuário
        if($row['tipo_usuario'] == '1') {
            header("Location: admin.php");
        } else {
            header("Location: usuario.php");
        }
    } else {
        header("Location: login.php");
        $_SESSION['mensagem_erro'] = "Usuário ou senha incorretos, tente novamente. ";
    }
} else {
    header("Location: login.php");
    $_SESSION['mensagem_erro'] = "Usuário ou senha incorretos, tente novamente. ";
}
?>