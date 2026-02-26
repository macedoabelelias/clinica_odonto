<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
require "protecao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Painel - AM Systems</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<style>

body{
    margin:0;
    background:#f4f6f9;
    font-family: Arial, sans-serif;
}

/* SIDEBAR */
.sidebar{
    width:220px;
    height:100vh;
    background:#0b5ed7;
    color:#fff;
    position:fixed;
    top:0;
    left:0;
    padding:20px;
}

/* Logo */
.sidebar .logo{
    margin-bottom:20px;
    font-weight:bold;
}

/* Links */
.sidebar a{
    display:block;
    color:#fff;
    text-decoration:none;
    padding:10px;
    border-radius:6px;
    margin-bottom:5px;
    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.2);
}

/* Botão sair */
.sidebar .sair{
    margin-top:20px;
    background:#dc3545;
    text-align:center;
}

/* TOPBAR */
.topbar{
    position: fixed;   /* fixa no topo */
    top: 0;
    left: 220px;
    right: 0;
    height: 60px;
    background:#fff;
    padding:15px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 2px 5px rgba(0,0,0,0.1);
    z-index: 999;
}

/* CONTEÚDO */
.content{
    margin-left:220px;
    margin-top:70px; /* 👈 ESSENCIAL */
    padding:20px;
}

.logo-menu{
    width: 150px;
    height: auto;
    display:block;
    margin:auto;
    border-radius:10px;
}

</style>


</head>

<body>

<?php include __DIR__ . "/menu.php"; ?>
<?php include __DIR__ . "/topo.php"; ?>

<div class="content">