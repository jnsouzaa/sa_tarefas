<?php
require_once '../config/db.php'; // Inclui a conexão

// 1. Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../cadastro.php'); // Redireciona para o cadastro
    exit();
}

// 2. Recebe os dados (APENAS os da sua modelagem)
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// 3. Validação (APENAS dos campos da modelagem)
if (empty($nome) || empty($email) || empty($senha)) {
    // Erro de campos vazios (sem ?tipo=...)
    header('Location: ../cadastro.php?erro=Todos os campos são obrigatórios.');
    exit();
}

try {
    // 4. Verifica se o E-MAIL já existe (sem checagem de CPF)
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    
    if ($stmt->fetch()) {
        // Mensagem de erro simplificada
        header('Location: ../cadastro.php?erro=Este e-mail já está cadastrado.');
        exit();
    }

    // 5. Hash da senha (mantido)
    // (PASSWORD_ARGON2ID é ótimo, mas PASSWORD_DEFAULT é mais comum e compatível)
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT); 
    
    // 6. INSERT simplificado (APENAS nome, email, senha)
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    
    // 7. Execute simplificado
    $stmt->execute([
        'nome' => $nome, 
        'email' => $email, 
        'senha' => $senhaHash, 
    ]);
    
    // 8. Sucesso
    header('Location: ../login.php?sucesso=Conta criada com sucesso! Faça o login.');
    exit();

} catch (PDOException $e) {
    // error_log($e->getMessage()); // Descomente para depurar
    header('Location: ../cadastro.php?erro=Ocorreu um erro no servidor.');
    exit();
}
?>