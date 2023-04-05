<?php
session_start();

// Verificar se há um parâmetro "erro" na URL

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Sistema de Reservas - Login</title>
</head>
<body>
    
    <main>
        <section>
            <h2>Seja bem-vindo!</h2>
            <p>Insira seu Usuário e Senha:</p>
            <?php
                if (isset($_SESSION['mensagem'])) {
                    echo "<p class= erro>" . $_SESSION['mensagem'] . "</p>";
                    unset($_SESSION['mensagem']);
                }
                ?>
            <form action="valida_login.php" method="post">
                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div>
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <button type="submit">Entrar</button>
            </form>
        </section>
    </main>

</body>
</html>