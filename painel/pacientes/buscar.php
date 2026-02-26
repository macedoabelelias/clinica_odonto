<?php
require "../../config/conexao.php";

$q = "%".$_GET['q']."%";

$sql = $pdo->prepare("SELECT * FROM pacientes WHERE nome LIKE ?");
$sql->execute([$q]);

foreach($sql as $p){
?>
<tr>
    <td><?= $p['nome'] ?></td>
    <td><?= $p['telefone'] ?></td>
    <td><?= $p['email'] ?></td>
    <td>
        <a href="editar.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
        <a href="prontuario.php?id=<?= $p['id'] ?>" class="btn btn-info btn-sm">Prontuário</a>
        <a href="excluir.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
    </td>
</tr>
<?php } ?>