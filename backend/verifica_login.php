<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    
    header('Location: ../login.php?erro=Por favor, faça o login para acessar esta página.');
    
    exit();
}

?>