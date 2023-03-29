<?php 
// Inicia a sessão para verificar se o usuário está autenticado e se é um administrador
session_start();
if(!isset($_SESSION['id_usuario'])) {
	// Redireciona o usuário para a página de login
	header("Location: login.php");
} 
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Página e Administração</title>
</head>
<body>
<div class="container">
        <div class="header">
            <h1>Sistema de Reservas</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="espacos.php">Espaços</a></li>
                    <li><a href="equipamentos.php">Equipamentos</a></li>
                    <li><a href="reservas.php">Reservas</a></li>
                    <li><a href="cadastro_usuario.php">Usuários</a></li>
                    <?php if ($_SESSION['tipo_usuario'] == 1): ?>
                    <li><a href="admin.php">administrador</a></li>
                    <?php endif; ?>
                    <li><a href="sair.php">Sair</a></li>
                </ul>
            </nav>

        </div>
        <div class="content">
            <h2>Bem-vindo ao Painel de Controle
            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        
            if(isset($_SESSION['nome_usuario'])) {
                $nome_usuario = $_SESSION['nome_usuario'];
                echo "<p>$nome_usuario!</p>";
            }
            ?>
            </h2>
            <p> Aqui você pode gerenciar as reservas, os espaços e os usuários.</p>
            <h3>Reservas Pendentes</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Espaço</th>
                        <th>Data</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once "conecta.php";
                        $sql = "SELECT r.id, u.nome as usuario, e.descricao as espaco, r.data, r.status FROM reservas r 
                        JOIN usuarios u ON r.id_usuario = u.id JOIN espacos e ON r.id_espaco = e.id WHERE r.status = 'pendente'";
                        $result = mysqli_query($conexao, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["usuario"] . "</td>";
                            echo "<td>" . $row["espaco"] . "</td>";
                            echo "<td>" . $row["data"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo "<td><a href='aprovar_reserva.php?id=" . $row["id"] . "'>Aprovar</a> | <a href='rejeitar_reserva.php?id="
                             . $row["id"] . "'>Rejeitar</a></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <h3>Equipamentos Disponíveis</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Quantidade Disponível</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM equipamentos";
                        $result = mysqli_query($conexao, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["descricao"] . "</td>";
                            echo "<td>" . $row["quantidade_disponivel"] . "</td>";
                            echo "<td>R$" . number_format($row["preco"], 2, ',', '.') . "</td>";
                            echo "</tr>";
                        }
                        mysqli_close($conexao);
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>