<?php
// backend/processa_cadastro.php
require_once '../config/db.php'; // Sobe um nível para achar o config

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../cadastrar.php');
    exit();
}

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($nome) || empty($email) || empty($senha)) {
    header('Location: ../cadastrar.php?erro=Todos os campos são obrigatórios.');
    exit();
}

try {
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    
    if ($stmt->fetch()) {
        header('Location: ../cadastrar.php?erro=Este e-mail já está cadastrado.');
        exit();
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT); 
    
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->execute([
        'nome' => $nome, 
        'email' => $email, 
        'senha' => $senhaHash, 
    ]);
    
    header('Location: ../login.php?sucesso=Conta criada com sucesso! Faça o login.');
    exit();

} catch (PDOException $e) {
    header('Location: ../cadastrar.php?erro=Ocorreu um erro no servidor.');
    exit();
}
?>