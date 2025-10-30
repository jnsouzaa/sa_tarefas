<?php
// backend/verifica_login.php
session_start();

// **CORREÇÃO CRÍTICA**: Verifica a chave 'user_id' que o login salvou
if (!isset($_SESSION['user_id'])) {
    
    // **CORREÇÃO CRÍTICA**: Redireciona subindo um nível (../)
    header('Location: ../login.php?erro=Por favor, faça o login para acessar esta página.');
    
    exit();
}
?>