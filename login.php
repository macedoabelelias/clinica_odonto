<?php
session_start();
require "config/conexao.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if(!$email || !$senha){
    $_SESSION['erro_login'] = "Preencha todos os campos";
    header("Location: index.php");
    exit;
}

$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND status = 1");
$sql->execute([$email]);

$user = $sql->fetch(PDO::FETCH_ASSOC);

if($user && password_verify($senha, $user['senha'])){

    $_SESSION['usuario_id']   = $user['id'];
    $_SESSION['usuario_nome'] = $user['nome'];
    $_SESSION['usuario_tipo'] = $user['tipo'];

    header("Location: painel/");
    exit;

}else{
    $_SESSION['erro_login'] = "Email ou senha inválidos";
    header("Location: index.php");
    exit;
}