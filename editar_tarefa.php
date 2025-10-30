<?php
// editar_tarefa.php
require_once 'backend/verifica_login.php'; 
require_once 'config/db.php';

$tarefa_id = $_GET['id'] ?? null;
$usuario_id = $_SESSION['user_id']; 

if (!$tarefa_id) {
    header('Location: home.php');
    exit();
}

try {
    $stmt = $conn->prepare("SELECT * FROM tarefas WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id' => $tarefa_id,
        'user_id' => $usuario_id
    ]);
    $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tarefa) {
        header('Location: home.php');
        exit();
    }
} catch (PDOException $e) {
    die("Erro ao buscar tarefa: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
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
        <form action="tarefas/atualizar_tarefa.php" method="POST">
            <h2>Editar Tarefa</h2>
            
            <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>">

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($tarefa['titulo']); ?>" required>
            
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($tarefa['descricao']); ?></textarea>
            
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="Pendente" <?php echo ($tarefa['status_tarefa'] == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                <option value="Em Andamento" <?php echo ($tarefa['status_tarefa'] == 'Em Andamento') ? 'selected' : ''; ?>>Em Andamento</option>
                <option value="Concluída" <?php echo ($tarefa['status_tarefa'] == 'Concluída') ? 'selected' : ''; ?>>Concluída</option>
            </select>
            
            <div class="form-botoes">
                <button type="submit">Salvar Alterações</button>
                <a href="home.php" class="btn-cancelar">Cancelar</a>
            </div>
            
        </form>
    </div>
</body>
</html>