<?php
require "../../config/conexao.php";

$paciente = $_POST['paciente'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$procedimento = $_POST['procedimento'];

$sql = $pdo->prepare("INSERT INTO agenda (paciente_id,data,hora,procedimento) VALUES (?,?,?,?)");
$sql->execute([$paciente,$data,$hora,$procedimento]);

header("Location: index.php");