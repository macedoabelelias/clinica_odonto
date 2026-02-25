<?php
require "../config/conexao.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$sql = $pdo->prepare("UPDATE pacientes SET nome=?, telefone=?, email=? WHERE id=?");
$sql->execute([$nome,$telefone,$email,$id]);

header("Location: index.php");