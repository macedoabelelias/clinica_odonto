<?php 
include "../layout.php";
require "../../config/conexao.php";

$dataHoje = date("Y-m-d");

$sql = $pdo->prepare("
    SELECT agenda.*, pacientes.nome 
    FROM agenda
    LEFT JOIN pacientes ON pacientes.id = agenda.paciente_id
    WHERE data = ?
    ORDER BY hora
");
$sql->execute([$dataHoje]);
?>
<style>
    .status-agendado { background:#fff3cd; }
    .status-confirmado { background:#cfe2ff; }
    .status-realizado { background:#d1e7dd; }
    .status-faltou { background:#f8d7da; }
    .status-cancelado { background:#e2e3e5; }
</style>

<h3>Agenda de hoje</h3>

<table class="table table-bordered">
<tr>
    <th>Hora</th>
    <th>Paciente</th>
    <th>Procedimento</th>
    <th>Status</th>
</tr>

<?php foreach($sql as $a): ?>

<tr>
    <td><?= $a['hora'] ?></td>
    <td><?= $a['nome'] ?></td>
    <td><?= $a['procedimento'] ?></td>
    <td>
<select onchange="mudarStatus(<?= $a['id'] ?>, this.value)" 
        class="form-select form-select-sm status-<?= strtolower($a['status']) ?>">

    <option value="Agendado" <?= $a['status']=="Agendado"?"selected":"" ?>>Agendado</option>
    <option value="Confirmado" <?= $a['status']=="Confirmado"?"selected":"" ?>>Confirmado</option>
    <option value="Realizado" <?= $a['status']=="Realizado"?"selected":"" ?>>Realizado</option>
    <option value="Faltou" <?= $a['status']=="Faltou"?"selected":"" ?>>Faltou</option>
    <option value="Cancelado" <?= $a['status']=="Cancelado"?"selected":"" ?>>Cancelado</option>

</select>
</td>

</td>
</tr>

<?php endforeach; ?>

</table>

</div>

<script>
function mudarStatus(id,status){

    fetch("../../ajax/mudar_status.php",{
        method:"POST",
        body:new URLSearchParams({ id:id, status:status })
    });

    // atualizar cor
    event.target.className = "form-select form-select-sm status-" + status.toLowerCase();
}
</script>

</body>
</html>