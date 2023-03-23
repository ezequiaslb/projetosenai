<?php
// Definir as variáveis para conexão com o banco de dados
$hostname = "localhost";   // Endereço do servidor de banco de dados
$username = "ezequias"; // Nome do usuário do banco de dados
$password = "[SYLlmSDrngBRroi";   // Senha do usuário do banco de dados
$dbname   = "colecoes_pessoais";  // Nome do banco de dados

// Conectar ao banco de dados usando a função mysqli_connect()
$conexao = mysqli_connect($hostname, $username, $password, $dbname);

// Verificar se houve erros na conexão
if (mysqli_connect_errno()) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}
else{
    echo("");
}

?>