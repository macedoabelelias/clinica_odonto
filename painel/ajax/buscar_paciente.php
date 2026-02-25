<?php
require "../config/conexao.php";

$busca = $_POST['busca'] ?? '';

$sql = $pdo->prepare("SELECT * FROM pacientes WHERE nome LIKE ? ORDER BY nome");
$sql->execute(["%$busca%"]);

foreach($sql as $p){
    echo "<tr>
            <td>{$p['nome']}</td>
            <td>{$p['telefone']}</td>
            <td>{$p['email']}</td>
            <td>
                <a href='editar.php?id={$p['id']}' class='btn btn-sm btn-warning'>Editar</a>
                <a href='prontuario.php?id={$p['id']}' class='btn btn-sm btn-info'>Prontuário</a>
            </td>
          </tr>";
}
?>

<script>
document.getElementById("busca").addEventListener("keyup",function(){

    fetch("../../ajax/buscar_paciente.php",{
        method:"POST",
        body:new URLSearchParams({
            busca:this.value
        })
    })
    .then(r=>r.text())
    .then(html=>{
        document.querySelector("#resultado table tbody").innerHTML = html;
    });

});
</script>