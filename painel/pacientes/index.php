<?php
include "../layout.php";
require "../../config/conexao.php";
?>

<input type="text" id="busca" class="form-control mb-3" placeholder="Buscar paciente...">
<div id="resultado">

<table class="table table-bordered">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Email</th>
        <th width="150">Ações</th>
    </tr>

<?php
$sql = $pdo->query("SELECT * FROM pacientes ORDER BY id DESC");
foreach($sql as $p):
?>

<tr>
    <td><?= $p['nome'] ?></td>
    <td><?= $p['telefone'] ?></td>
    <td><?= $p['email'] ?></td>
    <td>
        <a href="editar.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
        <a href="prontuario.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-info">
            Prontuário</a>
        <a href="excluir.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger"
           onclick="return confirm('Excluir paciente?')">Excluir</a>
    </td>
</tr>

<?php endforeach; ?>

</table>
</div>