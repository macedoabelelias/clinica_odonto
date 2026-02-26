<?php
include "../layout.php";
require "../../config/conexao.php";
?>

<div class="container" style="max-width:700px">

    <div class="card">
        <div class="card-header fw-bold">
            Novo paciente
        </div>

        <div class="card-body">

            <form method="POST" action="salvar_pacientes.php">

                <div class="mb-3">
                    <label>Nome</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Telefone</label>
                    <input type="text" name="telefone" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <button class="btn btn-success">Salvar paciente</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>

            </form>

        </div>
    </div>

</div>
