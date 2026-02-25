<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login - AM Systems Odontologia</title>

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
.overlay{
    position:absolute;
    width:100%;
    height:100%;
    background:rgba(14, 89, 202, 0.6);
    top:0;
    left:0;
}


.login-card{
    width:100%;
    max-width:400px;
    padding:40px;
    border-radius:15px;
    background:#ebfde9;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    animation:fadeIn 0.8s ease;
}

.logo img{
    max-width:320px;
    margin-bottom:15px;
}

.form-control{
    border-radius:10px;
    padding:12px;
}

.btn-login{
       background:#5c6162;
    color:#fff;
    border:none;
    padding:12px;
    font-weight:bold;
    border-radius:8px;
    margin-top:30px;
    transition:0.3s;
}

.btn-login:hover{
    background:#0b5ed7;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}


.login-card a{
    color:#0b5ed7;
    text-decoration:none;
    margin-top:15px;
    display:block;
    text-align:center;
}



.btn-login{
    background:#5c6162;
    border:none;
    padding:12px;
    font-weight:bold;
    border-radius:8px;
    margin-top:30px;
    transition:background 0.3s ease;
}

.btn-login:hover{
    background:#0b5ed7;
}

.d-block{
    color:#0b5ed7;
    text-decoration:none;
    margin-top:30px;
    text-align:center;
}   

</style>
</head>

<body>

<div class="login-card">

    <div class="logo">
        <img src="public/img/logo9.png" alt="AM Systems" style="max-width:320px; border-radius:10px;">
    </div>

    <?php if(isset($_SESSION['erro_login'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['erro_login']; unset($_SESSION['erro_login']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="login.php">

        <div class="mb-3">
            <label>E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
        </div>

        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required>
        </div>

        <button class="btn btn-login w-100" style="color:white;">Entrar</button>

        <div class="mt-3">

    <a href="recuperar.php" class="d-block" style="margin-top:20px; color:#0b5ed7; text-decoration:none;">
        Esqueceu sua senha?
    </a>


</div>

    </form>

</div>

</body>
</html>
