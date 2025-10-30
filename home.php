<?php
// home.php (Revertido para o layout de 2 colunas)

// 1. VERIFICA O LOGIN
require_once 'backend/verifica_login.php'; 

// 2. INCLUI A CONEXÃO
require_once 'config/db.php';

// 3. PEGA OS DADOS DA SESSÃO
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// 4. LÓGICA DE LEITURA (Read)
try {
    $stmt = $conn->prepare("SELECT * FROM tarefas WHERE user_id = :user_id ORDER BY data_criacao DESC");
    $stmt->execute(['user_id' => $user_id]);
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erro ao buscar tarefas: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Minhas Tarefas</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Momo+Trust+Display&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="favicons/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="container dashboard">
        <header>
            <h1>Olá, <?php echo htmlspecialchars($user_name); ?>!</h1>
            <a href="backend/logout.php" class="btn-logout">Sair</a>
        </header>

        <div class="form-container">
            <h2>Nova Tarefa</h2>
            <form action="tarefas/cadastrar_tarefa.php" method="POST">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                <label for="descricao">Descrição (Opcional):</label>
                <textarea id="descricao" name="descricao"></textarea>
                <button type="submit">Adicionar Tarefa</button>
            </form>
        </div>

        <div class="tarefas-container">
            <h2>Suas Tarefas</h2>
            <?php if (empty($tarefas)): ?>
                <p>Você ainda não tem nenhuma tarefa. Adicione uma acima!</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <?php
                            // Lógica para criar uma classe CSS amigável
                            $status_class = strtolower(str_replace(' ', '-', $tarefa['status_tarefa']));
                        ?>
                        <li class="tarefa status-<?php echo $status_class; ?>">
                            <div class="info">
                                <h3><?php echo htmlspecialchars($tarefa['titulo']); ?></h3>
                                <p><?php echo htmlspecialchars($tarefa['descricao']); ?></p>
                                <span class="status">[<?php echo $tarefa['status_tarefa']; ?>]</span>
                            </div>
                            <div class="acoes">
                                
                                <?php if ($tarefa['status_tarefa'] == 'Pendente'): ?>
                                    <a href="tarefas/mudar_status.php?id=<?php echo $tarefa['id']; ?>&novo=Em Andamento" class="btn-acao">Iniciar</a>
                                <?php elseif ($tarefa['status_tarefa'] == 'Em Andamento'): ?>
                                    <a href="tarefas/mudar_status.php?id=<?php echo $tarefa['id']; ?>&novo=Concluída" class="btn-acao">Concluir</a>
                                <?php endif; ?>
                                
                                <a href="editar_tarefa.php?id=<?php echo $tarefa['id']; ?>" class="btn-acao btn-editar">Editar</a>
                                <a href="tarefas/excluir_tarefa.php?id=<?php echo $tarefa['id']; ?>" class="btn-acao btn-excluir" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>