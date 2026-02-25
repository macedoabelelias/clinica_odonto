<?php include "../layout.php"; ?>

<h3>Novo paciente</h3>

<form method="POST" action="salvar.php">

    <div class="mb-3">
        <label>Nome</label>
        <input name="nome" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input name="telefone" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input name="email" class="form-control">
    </div>

    <button class="btn btn-success">Salvar</button>

</form>

</div>
</body>
</html>