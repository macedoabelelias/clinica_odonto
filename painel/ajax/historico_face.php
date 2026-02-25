<?php
require "../config/conexao.php";

$paciente = $_POST['paciente_id'];
$dente = $_POST['dente'];
$face = $_POST['face'];

$sql = $pdo->prepare("SELECT * FROM odontograma 
                      WHERE paciente_id=? AND dente=? AND face=? 
                      ORDER BY id DESC");
$sql->execute([$paciente,$dente,$face]);

if(!$sql->rowCount()){
    echo "<em>Sem histórico</em>";
}else{
    foreach($sql as $h){
        echo "<div style='border-bottom:1px solid #eee;padding:4px'>
                <strong>{$h['status']}</strong><br>
                <small>{$h['observacao']}</small><br>
                <small style='color:gray'>{$h['data']}</small>
              </div>";
    }
}