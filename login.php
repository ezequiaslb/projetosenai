    <?php
    session_start();
    require_once "conecta.php";
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sistema de Reservas de Espaços</title>
</head>
<body> 
    <div class="login-container">
    
     <form action="valida_login.php" method="post">
        <h2 class="titulo">Login</h2>
        <label for="username">Usuário:</label>
        <input type="text" name="email" id="username" required>
        <label for="password">Senha:</label>
        <input type="password" name="senha" id="password" required>
        <input type="submit" value="Entrar">
      </form>
      
    </div>
</body>
</html>

 <?php 
    /*if(isset($_SESSION['mensagem_erro'])) {
        echo "<div class='mensagem-erro'>" . $_SESSION['mensagem_erro'] . "</div>";
        unset($_SESSION['mensagem_erro']); // limpa a variável de sessão após exibir a mensagem
    }*/
    
    if(isset($_SESSION['mensagem_erro'])) {
        echo "<script>alert('" . $_SESSION['mensagem_erro'] . "')</script>";
        unset($_SESSION['mensagem_erro']); // limpa a variável de sessão após exibir a mensagem
    }
    ?> 