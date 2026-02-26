<?php
require "../../config/conexao.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // BUSCAR FOTO PARA APAGAR
    $sql = $pdo->prepare("SELECT foto FROM pacientes WHERE id=?");
    $sql->execute([$id]);
    $p = $sql->fetch();

    if($p && $p['foto']){
        $caminho = "../../public/uploads/".$p['foto'];
        if(file_exists($caminho)){
            unlink($caminho);
        }
    }

    // EXCLUIR PACIENTE
    $del = $pdo->prepare("DELETE FROM pacientes WHERE id=?");
    $del->execute([$id]);
}

header("Location: index.php");
exit;