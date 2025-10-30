<?php
// tarefas/excluir_tarefa.php
require_once '../backend/verifica_login.php'; // Caminho corrigido
require_once '../config/db.php';

$id = $_GET['id'] ?? null;
$usuario_id = $_SESSION['user_id']; // Chave corrigida

if (empty($id)) {
    header('Location: ../home.php');
    exit();
}

try {
    // **CORREÇÃO DB**: Verifica 'id' e 'user_id'
    $stmt = $conn->prepare("DELETE FROM tarefas WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'id' => $id,
        'user_id' => $usuario_id
    ]);

    header('Location: ../home.php');
    exit();

} catch (PDOException $e) {
    die("Erro ao excluir tarefa: " . $e->getMessage());
}
?>