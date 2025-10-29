<?php

$erro = $_GET['erro'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="conteiner-login">
    <form action="./backend/processa_login.php" method="post">
        <label for="nome">Nome</label>
        <input type="text" id="nome">
        
        <label for="nome">Senha</label>
        <input type="text" id="senha">

        <button class="btn">Entrar</button>
    </form>
    </div>
</body>
</html>