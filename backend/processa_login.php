<?php
session_start();
require_once '../config/db.php'; // Inclui a conexão

// Verifica se o formulário foi enviado (método POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../login.php?erro=Método inválido');
    exit();
}

// Pega os dados do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Validação simples
if (empty($email) || empty($senha)) {
    header('Location: ../login.php?erro=E-mail e senha são obrigatórios.');
    exit();
}

try {
    // Prepara e executa a busca pelo usuário no banco
    $stmt = $conn->prepare("SELECT id, nome, senha FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe E se a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        
        // Se deu tudo certo, salva os dados do usuário na sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        // REMOVIDO: $_SESSION['usuario_tipo'] não existe mais

        // === LÓGICA DE REDIRECIONAMENTO CORRIGIDA ===
        // Redireciona para a página principal de tarefas
        // (Conforme o plano original "Etapa 3: CRUD -> dashboard.php")
        header('Location: ../dashboard.php');
        exit();

    } else {
        // Se o email ou senha estiverem errados
        header('Location: ../login.php?erro=E-mail ou senha inválidos.');
        exit();
    }

} catch (PDOException $e) {
    // Se der um erro no banco de dados
    // error_log($e->getMessage()); // Descomente para depurar
    header('Location: ../login.php?erro=Ocorreu um erro no servidor.');
    exit();
}
?>