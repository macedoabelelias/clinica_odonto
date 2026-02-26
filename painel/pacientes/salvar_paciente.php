<?php
require "../../config/conexao.php";

/* ===== UPLOAD FOTO ===== */
$destino = dirname(__DIR__,2)."/public/uploads/";

if(!is_dir($destino)){
    mkdir($destino, 0777, true);
}

$fotoNome = null;

if(!empty($_FILES['foto']['name'])){
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fotoNome = uniqid().".".$ext;

    move_uploaded_file($_FILES['foto']['tmp_name'], $destino.$fotoNome);
}

/* ===== INSERT ===== */
$sql = $pdo->prepare("INSERT INTO pacientes 
(nome,data_nascimento,idade,telefone,email,cpf,cep,rua,numero,complemento,bairro,cidade,estado,profissao,escolaridade,genero,estado_civil,responsavel,resp_telefone,resp_email,resp_cpf,foto)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$sql->execute([
$_POST['nome'],
$_POST['data_nascimento'],
$_POST['idade'],
$_POST['telefone'],
$_POST['email'],
$_POST['cpf'],
$_POST['cep'],
$_POST['rua'],
$_POST['numero'],
$_POST['complemento'],
$_POST['bairro'],
$_POST['cidade'],
$_POST['estado'],
$_POST['profissao'],
$_POST['escolaridade'],
$_POST['genero'],
$_POST['estado_civil'],
$_POST['responsavel'],
$_POST['resp_telefone'],
$_POST['resp_email'],
$_POST['resp_cpf'],
$fotoNome
]);

header("Location: index.php");
exit