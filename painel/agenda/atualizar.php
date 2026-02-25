<?php
require "../../config/conexao.php";

$id = $_POST['id'];
$paciente = $_POST['paciente'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$procedimento = $_POST['procedimento'];

$sql = $pdo->prepare("UPDATE agenda SET paciente_id=?, data=?, hora=?, procedimento=? WHERE id=?");
$sql->execute([$paciente,$data,$hora,$procedimento,$id]);

header("Location: index.php");