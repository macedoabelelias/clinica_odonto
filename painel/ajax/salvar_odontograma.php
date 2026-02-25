<?php
require "../config/conexao.php";

$paciente = $_POST['paciente_id'];
$dente = $_POST['dente'];
$face = $_POST['face'];
$status = $_POST['status'];
$obs = $_POST['obs'];

$cores = [
    "cárie" => "red",
    "restauração" => "blue",
    "extraído" => "gray",
    "tratamento" => "yellow"
];

$cor = $cores[$status] ?? "white";

$sql = $pdo->prepare("INSERT INTO odontograma (paciente_id,dente,face,status,cor,observacao) VALUES (?,?,?,?,?,?)");
$sql->execute([$paciente,$dente,$face,$status,$cor,$obs]);