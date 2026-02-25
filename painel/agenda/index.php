<?php 
include "../layout.php";
require "../../config/conexao.php";
?>

<h3>Agenda</h3>

<a href="novo.php" class="btn btn-primary mb-3">Nova consulta</a>

<table class="table table-bordered">
<tr>
    <th>Paciente</th>
    <th>Data</th>
    <th>Hora</th>
    <th>Procedimento</th>
    <th width="150">Ações</th>
</tr>

<?php

$sql = $pdo->query("
    SELECT agenda.*, pacientes.nome 
    FROM agenda 
    LEFT JOIN pacientes ON pacientes.id = agenda.paciente_id
    ORDER BY data DESC, hora DESC
");

foreach($sql as $a):
?>



<tr>
    <td><?= $a['nome'] ?></td>
    <td><?= date('d/m/Y',strtotime($a['data'])) ?></td>
    <td><?= $a['hora'] ?></td>
    <td><?= $a['procedimento'] ?></td>

    <td>
    <a href="editar.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
    <a href="excluir.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-danger"
       onclick="return confirm('Excluir consulta?')">Excluir</a>
</td>
</tr>

<?php endforeach; ?>

</table>

</div>
</body>
</html>