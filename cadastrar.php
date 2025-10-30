<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Gestor de Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Momo+Trust+Display&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="favicons/icon.ico" type="image/x-icon">
</head>
<body>
    <video id="video-fundo" autoplay muted loop playsinline>
        <source src="videos/fundo.mp4" type="video/mp4">
        Seu navegador não suporta vídeos de fundo.
    </video>
    <div class="container">
        <form action="backend/processa_cadastro.php" method="POST">
            <h2>Cadastrar</h2>
            
            <?php if (isset($_GET['erro'])): ?>
                <div class="erro"><?php echo htmlspecialchars($_GET['erro']); ?></div>
            <?php endif; ?>

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <button type="submit">Cadastrar</button>
            <p>Já tem conta? <a href="login.php">Faça o login</a></p>
        </form>
    </div>
</body>
</html>