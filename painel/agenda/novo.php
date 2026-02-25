<?php
include "../layout.php";
require "../../config/conexao.php";

$pacientes = $pdo->query("SELECT * FROM pacientes ORDER BY nome");
?>

<h3>Nova consulta</h3>

<form method="POST" action="salvar.php">

<div class="mb-3">
<label>Paciente</label>
<select name="paciente" class="form-control">
<?php foreach($pacientes as $p): ?>
<option value="<?= $p['id'] ?>"><?= $p['nome'] ?></option>
<?php endforeach; ?>
</select>
</div>

<div class="mb-3">
<label>Data</label>
<input type="date" name="data" class="form-control">
</div>

<div class="mb-3">
<label>Hora</label>
<input type="time" name="hora" class="form-control">
</div>

<div class="mb-3">
<label>Procedimento</label>
<input name="procedimento" class="form-control">
</div>

<button class="btn btn-success">Salvar</button>

</form>

</div>
</body>
</html>