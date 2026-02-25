<?php
session_start();
require "config/conexao.php";

$email = $_POST['email'] ?? '';

if(!$email){
    $_SESSION['msg'] = "Informe um e-mail";
    header("Location: recuperar.php");
    exit;
}

$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
$sql->execute([$email]);

if($sql->rowCount()){
    $_SESSION['email_recuperacao'] = $email;
    header("Location: redefinir.php");
    exit;
}else{
    $_SESSION['msg'] = "E-mail não encontrado";
    header("Location: recuperar.php");
    exit;
}