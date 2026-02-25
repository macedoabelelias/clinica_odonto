<?php
include "../layout.php";
require "../../config/conexao.php";

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM agenda WHERE id=?");
$sql->execute([$id]);
$a = $sql->fetch();

$pacientes = $pdo->query("SELECT * FROM pacientes ORDER BY nome");
?>

<h3>Editar consulta</h3>

<form method="POST" action="atualizar.php">

<input type="hidden" name="id" value="<?= $a['id'] ?>">

<div class="mb-3">
<label>Paciente</label>
<select name="paciente" class="form-control">
<?php foreach($pacientes as $p): ?>
<option value="<?= $p['id'] ?>" <?= $p['id']==$a['paciente_id']?"selected":"" ?>>
    <?= $p['nome'] ?>
</option>
<?php endforeach; ?>
</select>
</div>

<div class="mb-3">
<label>Data</label>
<input type="date" name="data" value="<?= $a['data'] ?>" class="form-control">
</div>

<div class="mb-3">
<label>Hora</label>
<input type="time" name="hora" value="<?= $a['hora'] ?>" class="form-control">
</div>

<div class="mb-3">
<label>Procedimento</label>
<input name="procedimento" value="<?= $a['procedimento'] ?>" class="form-control">
</div>

<button class="btn btn-success">Atualizar</button>

</form>

</div>
</body>
</html>