<?php
include "../layout.php";
require "../../config/conexao.php";
?>

<!DOCTYPE html>
<div class="d-flex justify-content-between mb-3">
    <input type="text" id="busca" class="form-control w-50" placeholder="Buscar paciente...">

    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPaciente">
        + Novo paciente
    </button>
</div>

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
<body>
 <tbody id="tabelaPacientes">

 <!-- MODAL PACIENTE -->
<div class="modal fade" id="modalPaciente">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<form method="POST" action="/clinica_odonto/painel/pacientes/salvar_paciente.php" enctype="multipart/form-data">

<div class="modal-header">
    <h5><b>Cadastrar Paciente</b></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<!-- DADOS PESSOAIS -->
<h6 class="fw-bold">Dados pessoais</h6>
<hr>
<div class="row">

<div class="col-md-3 text-center mb-2">
<img id="previewFoto" src="../../public/img/user.png" style="width:120px;height:120px;border-radius:50%;">
<input type="file" name="foto" class="form-control mt-2" onchange="previewImagem(event)">
</div>

<div class="col-md-9">
<div class="row">

<div class="col-md-6 mb-2">
<label>Nome completo</label>
<input name="nome" class="form-control" required>
</div>

<div class="col-md-4 mb-2">
<label>Data nasc</label>
<input type="date" name="data_nascimento" id="dataNascimento" class="form-control" onchange="calcularIdade()">
</div>

<div class="col-md-2 mb-2">
<label>Idade</label>
<input name="idade" id="idade" class="form-control" readonly>
</div>

<div class="col-md-3 mb-2">
<label>Telefone</label>
<input name="telefone" id="telefone" class="form-control">
</div>

<div class="col-md-5 mb-2">
<label>Email</label>
<input name="email" class="form-control">
</div>

<div class="col-md-4 mb-2">
<label>CPF</label>
<input name="cpf" id="cpf" class="form-control">
</div>

</div>
</div>
</div>

<hr>

<!-- ENDEREÇO -->
<h6 class="fw-bold">Endereço</h6>
<hr>
<div class="row">

<div class="col-md-3 mb-2">
<label>CEP</label>
<input name="cep" id="cep" class="form-control">
</div>

<div class="col-md-7 mb-2">
<label>Rua</label>
<input name="rua" id="rua" class="form-control">
</div>

<div class="col-md-2 mb-2">
<label>Nº</label>
<input name="numero" class="form-control">
</div>

<div class="col-md-3 mb-2">
<label>Complemento</label>
<input name="complemento" class="form-control">
</div>

<div class="col-md-4 mb-2">
<label>Bairro</label>
<input name="bairro" id="bairro" class="form-control">
</div>

<div class="col-md-4 mb-2">
<label>Cidade</label>
<input name="cidade" id="cidade" class="form-control">
</div>

<div class="col-md-1 mb-2">
<label>UF</label>
<input name="estado" id="estado" class="form-control">
</div>

</div>

<hr>

<!-- SOCIAIS -->
<h6 class="fw-bold">Informações sociais</h6>
<hr>
<div class="row">

<div class="col-md-3 mb-2">
<label>Profissão</label>
<input name="profissao" class="form-control">
</div>

<div class="col-md-3 mb-2">
<label>Escolaridade</label>
    <select name="escolaridade" id="escolaridade" class="form-control">
        <option value="">Selecionar</option>
        <option value="Ensino Fundamental">Ensino Fundamental</option>
        <option value="Ensino Médio">Ensino Médio</option>
        <option value="Ensino Superior">Ensino Superior</option>
         <option value="Pós-Graduação">Pós-Graduação</option>
          <option value="Mestrado">Mestrado</option>
           <option value="Doutorado">Doutorado</option>
    </select>

</div>

<div class="col-md-3 mb-2">
<label>Gênero</label>
    <select name="genero" id="genero" class="form-control">
        <option value="">Selecionar</option>
        <option value="Masc">Cis Masculino</option>
        <option value="Fem">Cis Feminino</option>
        <option value="Trans">Transgênero</option>
        <option value="Outros">Outros</option>
    </select>
</div>

<div class="col-md-3 mb-2">
<label>Estado civil</label>
<select name="estado_civil" id="estadoCivil" class="form-control">
        <option value="">Selecionar</option>
        <option value="Solteiro(a)">Solteiro(a)</option>
        <option value="Casado(a)">Casado(a)</option>
        <option value="Divorciado(a)">Divorciado(a)</option>
        <option value="Viúvo(a)">Viúvo(a)</option>
    </select>
</div>

</div>

<hr>

<!-- RESPONSÁVEL -->
<h6 class="fw-bold">Responsável (se menor)</h6>
<hr>
<div class="row">

<div class="col-md-5 mb-2">
<label>Nome</label>
<input name="responsavel" class="form-control">
</div>

<div class="col-md-3 mb-2">
<label>Telefone</label>
<input name="resp_telefone" id="respTelefone" class="form-control">
</div>

<div class="col-md-4 mb-2">
<label>Email</label>
<input name="resp_email" class="form-control">
</div>

<div class="col-md-3 mb-2">
<label>CPF</label>
<input name="resp_cpf" id="respCpf" class="form-control">
</div>

</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
<button class="btn btn-success">Salvar</button>
</div>

</form>
</div>
</div>
</div>

<script src="https://unpkg.com/imask"></script>

<script>
function calcularIdade(){
    let nasc = document.getElementById("dataNascimento").value;
    let hoje = new Date();
    let n = new Date(nasc);
    let idade = hoje.getFullYear() - n.getFullYear();
    if(hoje.getMonth() < n.getMonth()) idade--;
    document.getElementById("idade").value = idade;
}

function previewImagem(e){
    let reader = new FileReader();
    reader.onload = () => previewFoto.src = reader.result;
    reader.readAsDataURL(e.target.files[0]);
}

cep.onblur = ()=>{
fetch(`https://viacep.com.br/ws/${cep.value}/json/`)
.then(r=>r.json())
.then(d=>{
rua.value=d.logradouro
bairro.value=d.bairro
cidade.value=d.localidade
estado.value=d.uf
});
}

</script>

<script src="https://unpkg.com/imask"></script>

<script>
IMask(document.getElementById('cpf'), {mask:'000.000.000-00'});
IMask(document.getElementById('telefone'), {mask:'(00)00000-0000'});
IMask(document.getElementById('respTelefone'), {mask:'(00)00000-0000'});
IMask(document.getElementById('cep'), {mask:'00000-000'});
</script>
</body>
</html>