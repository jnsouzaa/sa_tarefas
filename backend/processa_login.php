<?php
// backend/processa_login.php
session_start();
require_once '../config/db.php'; // Sobe um nível

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php?erro=Método inválido');
    exit();
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    header('Location: ../login.php?erro=E-mail e senha são obrigatórios.');
    exit();
}

try {
    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        
        // **CORREÇÃO CRÍTICA**: Salva na sessão com as chaves que seu home.php espera
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nome']; // 'user_name' para o PHP

        // Redireciona para o seu 'home.php'
        header('Location: ../home.php');
        exit();

    } else {
        header('Location: ../login.php?erro=E-mail ou senha inválidos.');
        exit();
    }

} catch (PDOException $e) {
    header('Location: ../login.php?erro=Ocorreu um erro no servidor.');
    exit();
}
?>