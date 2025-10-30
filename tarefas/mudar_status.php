<?php
// tarefas/mudar_status.php
require_once '../backend/verifica_login.php'; // Caminho corrigido
require_once '../config/db.php';

$id = $_GET['id'] ?? null;
$novo_status = $_GET['novo'] ?? '';
$usuario_id = $_SESSION['user_id']; // Chave corrigida

$status_permitidos = ['Pendente', 'Em Andamento', 'Concluída'];
if (empty($id) || empty($novo_status) || !in_array($novo_status, $status_permitidos)) {
    header('Location: ../home.php');
    exit();
}

try {
    // **CORREÇÃO DB**: Atualiza 'status_tarefa' e verifica 'user_id'
    $stmt = $conn->prepare("UPDATE tarefas SET status_tarefa = :status WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'status' => $novo_status,
        'id' => $id,
        'user_id' => $usuario_id
    ]);

    header('Location: ../home.php');
    exit();

} catch (PDOException $e) {
    die("Erro ao mudar status da tarefa: " . $e->getMessage());
}
?>