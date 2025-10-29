<?php
$erro = $_GET['erro'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="/sa_tarefas/css/cadastro.css">
</head>
<body>
    <main>
        <form action="auth/processa_cadastro.php" method="POST">
            <h2>Criar sua Conta</h2>

            <?php if ($erro): ?>
                <div class="erro"><?php echo htmlspecialchars($erro); ?></div>
            <?php endif; ?>

            <div>
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit">Cadastrar</button>

            <div class="link-login">
                Já tem uma conta? <a href="login.php">Faça o Login</a>
            </div>
        </form>
    </main>
</body>
</html>