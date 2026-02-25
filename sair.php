<?php
// Inicia sessão
session_start();

// Destroi sessão
session_unset();
session_destroy();

// Redireciona para login
header("Location: /clinica_odonto/login.php");
exit;
