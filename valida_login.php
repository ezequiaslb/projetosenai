<?php
// session_start();

// // Definir as variáveis para conexão com o banco de dados
// $hostname = "localhost";   // Endereço do servidor de banco de dados
// $username = "ezequias"; // Nome do usuário do banco de dados
// $password = "[SYLlmSDrngBRroi";   // Senha do usuário do banco de dados
// $dbname   = "sistemareservas";  // Nome do banco de dados

// // Conectar ao banco de dados usando a função mysqli_connect()
// $conexao = mysqli_connect($hostname, $username, $password, $dbname);

// // Verificar se houve erros na conexão
// if (mysqli_connect_errno()) {
//     die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
// }

// // Receber os dados do formulário
// $email = $_POST['email'];
// $senha = $_POST['senha'];

// // Preparar a consulta SQL para buscar o usuário no banco de dados
// $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

// // Executar a consulta SQL
// $resultado = mysqli_query($conexao, $sql);

// // Verificar se a consulta retornou algum resultado
// if (mysqli_num_rows($resultado) > 0) {
//     // O usuário foi encontrado, verificar se é um administrador ou não
//     $usuario = mysqli_fetch_assoc($resultado);
//     if ($usuario['tipo_usuario'] == 1) {
//         // O usuário é um administrador, redirecionar para a página de administração
//         $_SESSION['admin'] = true;
//         header('Location: painel_adm.php');
//     } else {
//         // O usuário é um usuário comum, redirecionar para a página de usuário
//         $_SESSION['admin'] = false;
//         header('Location: user.php');
//     }
// } else {
//     // O usuário não foi encontrado, exibir mensagem de erro e redirecionar para a página de login
//     $_SESSION['mensagem'] = 'E-mail ou senha incorretos';
//     header('Location: index.php');
// }

// Inclui o arquivo de conexão com o banco de dados
include 'conecta.php';

// Inicia a sessão do usuário
session_start();

// Verifica se o formulário foi enviado
if(isset($_POST['email']) && isset($_POST['senha'])) {
    // Atribui os valores dos campos de email e senha para as variáveis
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Prepara a consulta SQL para buscar o usuário no banco de dados
    $consulta = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";

    // Executa a consulta no banco de dados
    $resultado = mysqli_query($conexao, $consulta);

    // Verifica se foi encontrado um usuário com os dados informados
    if(mysqli_num_rows($resultado) == 1) {
        // Armazena os dados do usuário em um array associativo
        $usuario = mysqli_fetch_assoc($resultado);

        // Cria uma variável de sessão com o id do usuário
        $_SESSION['id_usuario'] = $usuario['id'];

        // Verifica o tipo de usuário (administrador ou usuário padrão)
        if($usuario['tipo_usuario'] == 1) {
            // Se for um administrador, redireciona para a página do painel administrativo
            header('Location: painel_adm.php');
            exit;
        } else {
            // Se for um usuário padrão, redireciona para a página do usuário
            header('Location: user.php');
            exit;
        }
    } else {
        // Caso contrário, exibe uma mensagem de erro e redireciona para a página de login
        $_SESSION['mensagem'] = 'Email ou senha inválidos';
        header('Location: index.php');
        exit;
    }
} else {
    // Caso o formulário não tenha sido enviado, redireciona para a página de login
    header('Location: login.php');
    exit;
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>
