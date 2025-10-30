<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Gestor de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Momo+Trust+Display&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="favicons/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
        <form action="backend/processa_login.php" method="POST">
            <h2>Login</h2>

            <?php if (isset($_GET['erro'])): ?>
                <div class="erro"><?php echo htmlspecialchars($_GET['erro']); ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['sucesso'])): ?>
                <div class="sucesso"><?php echo htmlspecialchars($_GET['sucesso']); ?></div>
            <?php endif; ?>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <button type="submit">Entrar</button>
            <p>Não tem conta? <a href="cadastrar.php">Cadastre-se</a></p>
        </form>
    </div>
</body>
</html>