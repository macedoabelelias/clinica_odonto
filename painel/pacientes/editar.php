<?php
include "../layout.php";
require "../../config/conexao.php";

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM pacientes WHERE id = ?");
$sql->execute([$id]);
$p = $sql->fetch();
?>

<h3>Editar paciente</h3>

<form method="POST" action="atualizar.php">

    <input type="hidden" name="id" value="<?= $p['id'] ?>">

    <div class="mb-3">
        <label>Nome</label>
        <input name="nome" class="form-control" value="<?= $p['nome'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Telefone</label>
        <input name="telefone" class="form-control" value="<?= $p['telefone'] ?>">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input name="email" class="form-control" value="<?= $p['email'] ?>">
    </div>

    <button class="btn btn-primary">Atualizar</button>

</form>

</div>
</body>
</html>