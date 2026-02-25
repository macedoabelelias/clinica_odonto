<?php
include "../layout.php";
require "../../config/conexao.php";

$id = $_GET['id'];

$sql = $pdo->prepare("SELECT * FROM pacientes WHERE id = ?");
$sql->execute([$id]);
$p = $sql->fetch();
?>

<div class="container-fluid">
    <div style="max-width:1200px; margin:auto;">
<div class="card mb-3">
    <div class="card-header fw-bold">
        Prontuário do paciente
    </div>
<div class="card-body">
    <strong><?= $p['nome'] ?></strong><br>
    Telefone: <?= $p['telefone'] ?><br>
    Email: <?= $p['email'] ?>
</div>
</div>

<div style="max-width:1100px; margin:auto; padding:10px;">

<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a class="nav-link active">Odontograma</a></li>
    <li class="nav-item"><a class="nav-link ">Histórico</a></li>
    <li class="nav-item"><a class="nav-link">Orçamentos</a></li>
    <li class="nav-item"><a class="nav-link">Tratamentos</a></li>
</ul>


<style>


.legenda-box{
    width:30%;
    background:#fff;
    border-radius:8px;
    padding:15px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

.legenda-item{
    padding:8px;
    border-radius:6px;
    cursor:pointer;
}

.legenda-item:hover{
    background:#f1f1f1;
}

.prontuario-grid{
    display:grid;
    grid-template-columns: 2fr 1fr;
    gap:20px;
}



.painel-clinico .card{
    padding:15px;
    border-radius:8px;
}

.prontuario-wrap{
    display:flex;
    gap:20px;
    align-items:flex-start;
}

/* LAYOUT GERAL */
.odontograma-layout{
    align-items:stretch;
}

/* ODONTOGRAMA */
.odontograma-box{
    flex:1.2;
}

/* COLUNA DIREITA */
.odontograma-side{
    justify-content:space-between;
}

/* CARDS */
.card-odonto{
    background:#fff;
    border-radius:10px;
    padding:12px 15px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

/* TÍTULOS */
.card-odonto h6{
    margin-bottom:8px;
    font-weight:600;
}

/* TEXTAREA */
.card-odonto textarea{
    height:80px;
    resize:none;
}

/* COLUNA ODONTOGRAMA */
.odontograma-col{
    flex:2;
}

/* COLUNA LATERAL */
.painel-col{
    flex:1;
}

/* BOX ODONTOGRAMA */
.odontograma-box img{
    width:100%;
    height:auto;
}

/* IMAGEM ODONTO */
.img-odonto{
    width:100%;
    height:auto;
    display:block;
}

/* SVG SOBRE A IMAGEM */
#odontograma{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
}
</style>

<div class="row">

<div class="col-md-8">

    <!-- BOTÕES -->
    <div class="mb-2">
        <button class="btn btn-primary btn-sm" onclick="carregarOdonto('perm')">Permanente</button>
        <button class="btn btn-outline-primary btn-sm" onclick="carregarOdonto('dec')">Decíduo</button>
    </div>

    <div class="card p-3 text-center">

        <div style="position:relative; width:100%; max-width:900px; margin:auto;">

            <img id="imgOdonto" src="../../public/img/odonto_perm.jpg"
                 style="width:100%; display:block;">

            <svg id="odontograma"
                 viewBox="0 0 900 300"
                 style="position:absolute; top:0; left:0; width:100%; height:100%;">
            </svg>

        </div>

    </div>

</div>

<!-- PAINEL LATERAL -->
<div class="col-md-4">
    <div class="card p-3 mb-2">
        <h6>Procedimentos</h6>
        <div>🟥 Cárie</div>
        <div>🟦 Restauração</div>
        <div>❌ Extraído</div>
        <div>🔩 Implante</div>
        <div>👑 Coroa</div>
    </div>

    <div class="card p-3 mb-2">
        <h6>Histórico</h6>
        <div id="historico-dente">Selecione uma face</div>
    </div>

    <div class="card p-3">
        <h6>Anotações</h6>
        <textarea class="form-control"></textarea>
    </div>
</div>

</div>

<!-- // Carregar cores do banco -->
<script>
$cores = $pdo->prepare("SELECT * FROM odontograma WHERE paciente_id=?");
$cores->execute([$id]);
</script>

<div class="card p-4 text-center">
    <svg id="odontograma" viewBox="0 0 900 300" style="width:100%"></svg>
</div>

<!-- MODAL -->
<div class="modal fade" id="modalProc">
  <div class="modal-dialog">
    <div class="modal-content p-3">

        <h5>Procedimento</h5>

        <div id="historico" style="max-height:150px; overflow:auto; font-size:13px;" class="mb-2">
            <em>Sem histórico</em>
        </div>

        <select id="status" class="form-control mb-2">
            <option value="cárie">Cárie</option>
            <option value="restauração">Restauração</option>
            <option value="extraído">Extraído</option>
            <option value="tratamento">Tratamento</option>
        </select>

        <textarea id="obs" class="form-control mb-2" placeholder="Observação"></textarea>

        <button onclick="salvarFace()" class="btn btn-success">Salvar</button>

    </div>
  </div>
</div>

<script>
function mostrarOdonto(tipo){
    document.getElementById('odonto-perm').style.display = tipo==='perm'?'block':'none';
    document.getElementById('odonto-dec').style.display = tipo==='dec'?'block':'none';

    document.getElementById('btn-perm').classList.toggle('btn-primary',tipo==='perm');
    document.getElementById('btn-dec').classList.toggle('btn-primary',tipo==='dec');
}
</script>

<script>
let svg = document.getElementById("odontograma");

function criarDente(dente,x,y){

    let faces = [
        {f:"vestibular",x:x+6,y:y},
        {f:"lingual",x:x+6,y:y+18},
        {f:"mesial",x:x,y:y+6},
        {f:"distal",x:x+12,y:y+6},
        {f:"oclusal",x:x+6,y:y+6}
    ];

    faces.forEach(face=>{
        let r = document.createElementNS("http://www.w3.org/2000/svg","rect");

        r.setAttribute("id",`${dente}-${face.f}`);
        r.setAttribute("x",face.x);
        r.setAttribute("y",face.y);
        r.setAttribute("width",14);
        r.setAttribute("height",14);
        r.setAttribute("fill","#fff");
        r.setAttribute("stroke","#000");

        r.addEventListener("click",()=>{
            faceAtual = r.id;
            new bootstrap.Modal(document.getElementById('modalProc')).show();
        });

        svg.appendChild(r);
    });
}

let mapaPerm = {
"18":[38,56],"17":[93,56],"16":[152,56],"15":[210,56],
"14":[256,56],"13":[302,56],"12":[350,56],"11":[400,56],
"21":[476,56],"22":[525,56],"23":[570,56],"24":[620,56],
"25":[665,56],"26":[722,56],"27":[780,56],"28":[836,56],

"48":[48,216],"47":[110,216],"46":[178,216],"45":[238,216],
"44":[284,216],"43":[332,216],"42":[374,216],"41":[411,216],
"31":[470,216],"32":[508,216],"33":[548,216],"34":[595,216],
"35":[646,216],"36":[706,216],"37":[772,216],"38":[830,216]
};

let mapaDec = {
"55":[48,49],"54":[123,49],"53":[187,49],"52":[243,49],"51":[300,49],
"61":[388,49],"62":[448,49],"63":[502,49],"64":[568,49],"65":[646,49],

"85":[50,240],"84":[140,240],"83":[208,240],"82":[260,240],"81":[305,240],
"71":[381,240],"72":[432,240],"73":[482,240],"74":[550,240],"75":[638,240]
};

function carregarOdonto(tipo){

    svg.innerHTML = "";
    let img = document.getElementById("imgOdonto");

    if(tipo==="perm"){
        img.src="../../public/img/odonto_perm.jpg";
        img.style.width="100%";          // tamanho normal
        img.style.maxWidth="900px";

        Object.entries(mapaPerm).forEach(([d,p])=>criarDente(d,p[0],p[1]));

    }else{
        img.src="../../public/img/odonto_dec.jpg";

        img.style.width="80%";           // 🔥 diminui só o decíduo
        img.style.maxWidth="650px";

        Object.entries(mapaDec).forEach(([d,p])=>criarDente(d,p[0],p[1]));
    }
}


let faces = [
    {f:"vestibular",x:x+6,y:y},
    {f:"lingual",x:x+6,y:y+18},
    {f:"mesial",x:x,y:y+6},
    {f:"distal",x:x+12,y:y+6},
    {f:"oclusal",x:x+6,y:y+6}
];



        

    faces.forEach(face=>{
        let r = document.createElementNS("http://www.w3.org/2000/svg","rect");

        r.setAttribute("id",`${dente}-${face.f}`);
        r.setAttribute("x",face.x);
        r.setAttribute("y",face.y);
        r.setAttribute("width",14);
        r.setAttribute("height",14);
        r.setAttribute("fill","#fff");
        r.setAttribute("stroke","#000");

        r.addEventListener("click",()=>{
            faceAtual = r.id;
            carregarHistorico(faceAtual);
            new bootstrap.Modal(document.getElementById('modalProc')).show();
        });

        svg.appendChild(r);
    });


/* HISTÓRICO */
function carregarHistorico(faceId){
    let partes = faceId.split("-");
    let dente = partes[0];
    let face = partes[1];

    fetch("../ajax/historico_face.php",{
        method:"POST",
        body:new URLSearchParams({
            paciente_id: <?= $id ?>,
            dente:dente,
            face:face
        })
    })
    .then(r=>r.text())
    .then(html=>{
        document.getElementById("historico").innerHTML = html;
    });
}

/* SALVAR */
function salvarFace(){
    let partes = faceAtual.split("-");
    let dente = partes[0];
    let face = partes[1];

    fetch("../ajax/salvar_odontograma.php",{
        method:"POST",
        body:new URLSearchParams({
            paciente_id: <?= $id ?>,
            dente:dente,
            face:face,
            status:document.getElementById("status").value,
            obs:document.getElementById("obs").value
        })
    }).then(()=>location.reload());
}
</script>

<!-- CARREGAR CORES -->
<script>
let coresDB = <?= json_encode($cores->fetchAll(PDO::FETCH_ASSOC)); ?>;

setTimeout(()=>{
    coresDB.forEach(c=>{
        let el = document.getElementById(`${c.dente}-${c.face}`);
        if(el) el.style.fill = c.cor;
    });
},400);

let ferramenta = "";

function setTool(tool){
    ferramenta = tool;
}

if(ferramenta){
    aplicarSimbolo(r, ferramenta);
    return;
}

function aplicarSimbolo(face, tipo){

    if(tipo=="carie") face.style.fill = "red";
    if(tipo=="restauracao") face.style.fill = "blue";
    if(tipo=="extraido") face.style.fill = "black";

    if(tipo=="implante"){
        let t = document.createElementNS("http://www.w3.org/2000/svg","text");
        t.setAttribute("x", face.getAttribute("x"));
        t.setAttribute("y", face.getAttribute("y")+10);
        t.textContent = "🔩";
        svg.appendChild(t);
    }

}

</script>

</body>
</html>