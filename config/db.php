<?php
// config/db.php

$host = 'localhost';
$db_name = 'sa_tarefas'; // Nome do seu banco
$username = 'root'; 
$password = ''; // Sua senha (se houver)

try {
    $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
?>