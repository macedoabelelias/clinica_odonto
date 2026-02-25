<?php
session_start();
require "config/conexao.php";

if(!isset($_SESSION['email_recuperacao'])){
    header("Location: index.php");
    exit;
}

$senha = $_POST['senha'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if($senha != $confirmar){
    $_SESSION['msg'] = "As senhas não conferem";
    header("Location: redefinir.php");
    exit;
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
$sql->execute([$hash, $_SESSION['email_recuperacao']]);

unset($_SESSION['email_recuperacao']);

$_SESSION['erro_login'] = "Senha redefinida com sucesso!";
header("Location: index.php");
exit;