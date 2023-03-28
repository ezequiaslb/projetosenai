<?php 
// Inicia a sessão para verificar se o usuário está autenticado e se é um administrador
session_start();
if(!isset($_SESSION['id_usuario'])) {
	// Redireciona o usuário para a página de login
	header("Location: login.php");
} 
require_once "conecta.php";






?>