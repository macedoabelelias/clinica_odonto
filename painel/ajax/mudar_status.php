<?php
require "../config/conexao.php";

$id = $_POST['id'];
$status = $_POST['status'];

$sql = $pdo->prepare("UPDATE agenda SET status=? WHERE id=?");
$sql->execute([$status,$id]);