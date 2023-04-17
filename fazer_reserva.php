<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
	<title>Fazer Reserva</title>
	<script>
		function toggleForm(formId) {
			var form = document.getElementById(formId);
			form.style.display = (form.style.display == "none" ? "block" : "none");
		}
	</script>
</head>
<body>
<header>
        <h1>Sistema de Reservas</h1>
        
            <ul>
                <li><a href="user.php">Lista de Reservas</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>
    </header>
	<main>
        <h1>Tipo de Reservas</h1>
        <button onclick="toggleForm('formEspaco')">Reservar Espaço</button>
        <button onclick="toggleForm('formEquipamento')">Reservar Equipamento</button>
        <form id="formEspaco" style="display: none;">
            <h2>Reservar Espaço</h2>
            <!-- Campos para reservar espaço -->
            <div class="form-group">
            <label for="espaco">Espaço:</label>
            <select name="espaco" id="espaco" required>
              <option value="">Selecione um espaço</option>
              <!-- Aqui você pode incluir opções com os espaços disponíveis -->
            </select>
            </div>
            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" name="data" id="data" required>
            </div>
            <div class="form-group">
                <label for="hora-inicio">Hora de Início:</label>
                <input type="time" name="hora-inicio" id="hora-inicio" required>
            </div>
            <div class="form-group">
                <label for="hora-fim">Hora de Término:</label>
                <input type="time" name="hora-fim" id="hora-fim" required>
            </div>
            <button type="submit">Reservar</button>
            </form>

        
        <form id="formEquipamento" style="display: none;">
            <h2>Reservar Equipamento</h2>
            <!-- Campos para reservar equipamento -->
        </form>
    </main>
</body>
</html>