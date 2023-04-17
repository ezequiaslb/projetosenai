<?php
session_start();

// Verificar se o usuário está logado como admin ou usuário padrão
if(!isset($_SESSION['admin']) || $_SESSION['admin']) {
    // Redireciona para a página de login se não estiver logado como usuário padrão
    header('Location: index.php');
    exit();
}
// Incluir o arquivo de conexão com o banco de dados
include 'conecta.php';

if (isset($usuario['id'])) {
    $id_usuario = $usuario['id'];
 } else {
    // faça algo caso o índice não esteja definido, como redirecionar o usuário para uma página de erro
    
 }
// Definir a variável id_usuario com o id do usuário logado
$id_usuario = $_SESSION['id_usuario'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de Reservas - Usuário</title>
</head>
<body>

    <header>
        <h1>Sistema de Reservas</h1>
        
            <ul>
                <li><a href="fazer_reserva.php">Fazer Reserva</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        
    </header>
    <main>
        <section>
            
            <!-- Tabela de reservas de espaços -->
                <table>
                <h2>Minhas Reservas de Espaços</h2>
                <thead>
                    <tr>
                    <th>Espaço</th>
                    <th>Data</th>
                    <th>Horário de início</th>
                    <th>Horário de término</th>
                    <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta SQL para obter as reservas de espaços do usuário
                    $sql_espacos = "SELECT r.id, e.descricao, r.data, r.data_inicio, r.data_fim 
                                    FROM reservas r
                                    INNER JOIN espacos e ON r.id_espaco = e.id
                                    WHERE r.id_usuario = $id_usuario";

                    $resultado_espacos = mysqli_query($conexao, $sql_espacos);

                    // Preencher a tabela HTML com as reservas de espaços
                    while ($linha_espacos = mysqli_fetch_assoc($resultado_espacos)) {
                        echo "<tr>";
                        echo "<td>" . $linha_espacos['descricao'] . "</td>";
                        echo "<td>" . $linha_espacos['data'] . "</td>";
                        echo "<td>" . $linha_espacos['data_inicio'] . "</td>";
                        echo "<td>" . $linha_espacos['data_fim'] . "</td>";
                        echo "<td><a href='#'>Cancelar</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                </table>

    <!-- Tabela de reservas de equipamentos -->
                <h2>Minhas Reservas de Equipamentos</h2>
                    <table>
                    <thead>
                        <tr>
                        <th>Equipamento</th>
                        <th>Data</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta SQL para obter as reservas de equipamentos do usuário
                        $sql_equipamentos = "SELECT re.id, eq.descricao, re.data, re.quantidade 
                                            FROM reservas_equipamentos re
                                            INNER JOIN equipamentos eq ON re.id_equipamento = eq.id
                                            WHERE re.id_usuario = $id_usuario";

                        $resultado_equipamentos = mysqli_query($conexao, $sql_equipamentos);

                        // Preencher a tabela HTML com as reservas de equipamentos
                        while ($linha_equipamentos = mysqli_fetch_assoc($resultado_equipamentos)) {
                            echo "<tr>";
                            echo "<td>" . $linha_equipamentos['descricao'] . "</td>";
                            echo "<td>" . $linha_equipamentos['data'] . "</td>";
                            echo "<td>" . $linha_equipamentos['quantidade'] . "</td>";
                            echo "<td><a href='#'>Cancelar</a></td>";
                            echo "</tr>";
                        }
                        ?>
                </tbody>
                </table>
        </section>
    </main>

</body>
</html>

<?php
// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?> 