<?php
require "../../config/conexao.php";

$id = $_GET['id'];

$sql = $pdo->prepare("DELETE FROM agenda WHERE id=?");
$sql->execute([$id]);

header("Location: index.php");