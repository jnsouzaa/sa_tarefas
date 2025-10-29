<?php
// Define as informações de conexão com o banco de dados
$host = 'localhost';
$db_name = 'sa_tarefas'; // Verifique se o nome do seu banco é este
$username = 'root';
$password = '';      // Senha do seu MySQL (geralmente vazia no Laragon/XAMPP)

try {
    // Cria a conexão usando PDO (a forma segura)
    $conn = new PDO("mysql:host={$host};dbname={$db_name};charset=utf8", $username, $password);
    
    // Configura o PDO para lançar exceções em caso de erro
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configura para que os resultados venham como arrays associativos por padrão
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // Se a conexão falhar, interrompe tudo e mostra o erro.
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>