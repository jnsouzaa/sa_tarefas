<?php
// tarefas/atualizar_tarefa.php
require_once '../backend/verifica_login.php'; // Caminho corrigido
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../home.php');
    exit();
}

$id = $_POST['id'] ?? null;
$titulo = $_POST['titulo'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$status = $_POST['status'] ?? ''; // Vem do <select>
$usuario_id = $_SESSION['user_id']; // Chave corrigida

if (empty($id) || empty($titulo) || empty($status)) {
    header('Location: ../home.php');
    exit();
}

try {
    // **CORREÇÃO DB**: Atualiza 'status_tarefa' e verifica 'user_id'
    $stmt = $conn->prepare("UPDATE tarefas SET titulo = :titulo, descricao = :descricao, status_tarefa = :status WHERE id = :id AND user_id = :user_id");
    
    $stmt->execute([
        'titulo' => $titulo,
        'descricao' => $descricao,
        'status' => $status, // O valor do select ('Pendente', etc.)
        'id' => $id,
        'user_id' => $usuario_id
    ]);

    header('Location: ../home.php');
    exit();

} catch (PDOException $e) {
    die("Erro ao atualizar tarefa: " . $e->getMessage());
}
?>