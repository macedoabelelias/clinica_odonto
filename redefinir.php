<?php
session_start();

if(!isset($_SESSION['email_recuperacao'])){
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Redefinir senha - AM Systems</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="public/css/auth.css">
</head>

<body>

<div class="login-card text-center">

    <div class="logo">
        <img src="public/img/logo.png" alt="AM Systems">
    </div>

    <h5 class="mb-3">Criar nova senha</h5>

    <?php if(isset($_SESSION['msg'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['msg']; unset($_SESSION['msg']); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="salvar_nova_senha.php">

        <div class="mb-3 text-start">
            <label>Nova senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
            <label>Confirmar senha</label>
            <input type="password" name="confirmar" class="form-control" required>
        </div>

        <button class="btn btn-login w-100">Salvar nova senha</button>

    </form>

</div>

</body>
</html>