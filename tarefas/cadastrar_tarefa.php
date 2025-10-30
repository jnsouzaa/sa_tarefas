<?php
// tarefas/cadastrar_tarefa.php
require_once '../backend/verifica_login.php'; // Caminho corrigido
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../home.php');
    exit();
}

$titulo = $_POST['titulo'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$usuario_id = $_SESSION['user_id']; // Chave corrigida

if (empty($titulo)) {
    header('Location: ../home.php'); // Redireciona para home.php
    exit();
}

try {
    // **CORREÇÃO DB**: Insere em 'user_id'
    $stmt = $conn->prepare("INSERT INTO tarefas (titulo, descricao, user_id) VALUES (:titulo, :descricao, :user_id)");
    $stmt->execute([
        'titulo' => $titulo,
        'descricao' => $descricao,
        'user_id' => $usuario_id
    ]);

    header('Location: ../home.php');
    exit();

} catch (PDOException $e) {
    die("Erro ao cadastrar tarefa: " . $e->getMessage());
}
?>