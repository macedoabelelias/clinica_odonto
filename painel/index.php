<?php
session_start();
require "protecao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Painel - AM Systems</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f4f6f9;
}

.topbar{
    background:#0b5ed7;
    color:#fff;
    padding:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.card{
    border:none;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}
</style>
</head>

<body>

<div class="topbar">
    <div>
        <strong>AM Systems Odontologia</strong>
    </div>

    <div>
        Olá, <?= $_SESSION['usuario_nome']; ?> |
        <a href="sair.php" class="text-white">Sair</a>
    </div>
</div>

<?php include "layout.php"; ?>

<h3>Dashboard</h3>

<div class="container mt-4">

    <div class="row g-3">

        <div class="col-md-3">
            <div class="card p-3">
                <h6>Pacientes</h6>
                <h3>0</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h6>Consultas hoje</h6>
                <h3>0</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h6>Recebimentos</h6>
                <h3>R$ 0,00</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3">
                <h6>Tratamentos</h6>
                <h3>0</h3>
            </div>
        </div>

    </div>

</div>

</body>
</html>