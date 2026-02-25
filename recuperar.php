<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Recuperar senha - AM Systems</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="public/css/auth.css">

<style>

body{
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#69e1de;
    font-family: Arial, sans-serif;
}

/* Card recuperar */
.card-recuperar{
    width:100%;
    max-width:400px;
    padding:40px;
    border-radius:15px;
    background:#ebfde9;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    animation:fadeIn 0.8s ease;
}

/* Logo */
.logo img{
    max-width:320px;
    margin-bottom:15px;
}

/* Inputs */
.form-control{
    border-radius:10px;
    padding:12px;
}

/* Botão */
.btn-enviar{
    background:#5c6162;
    color:#fff;
    border:none;
    padding:12px;
    font-weight:bold;
    border-radius:8px;
    margin-top:20px;
    transition:0.3s;
}

.btn-enviar:hover{
    background:#0b5ed7;
}

/* Links */
.card-recuperar a{
    color:#0b5ed7;
    text-decoration:none;
    margin-top:15px;
    display:block;
    text-align:center;
}

.card-recuperar a:hover{
    text-decoration:underline;
}

/* Animação */
@keyframes fadeIn{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}

</style>
</head>

<body>

<div class="overlay"></div>

<div class="container-recuperar">

    <div class="card-recuperar text-center">

       <div class="logo">
        <img src="public/img/logo9.png" alt="AM Systems" style="max-width:320px; border-radius:10px;">
    </div>

        <h5 class="mb-3">Recuperar senha</h5>
        <p class="small mb-4">
            Informe seu e-mail para receber instruções de redefinição.
        </p>

        <?php if(isset($_SESSION['msg'])): ?>
            <div class="alert alert-info">
                <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="enviar_recuperacao.php">

            <div class="mb-3 text-start">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <button class="btn btn-enviar w-100">Enviar instruções</button>

        </form>

        <div class="mt-3">
            <a href="index.php">← Voltar ao login</a>
        </div>

    </div>

</div>

</body>
</html>