<?php
require "../config/conexao.php";

$nome = $_POST['nome'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';

$sql = $pdo->prepare("INSERT INTO pacientes (nome,telefone,email) VALUES (?,?,?)");
$sql->execute([$nome,$telefone,$email]);

header("Location: index.php");