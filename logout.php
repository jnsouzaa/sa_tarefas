<?php
session_start();
session_unset();
session_destroy();

// CORREÇÃO: Usando ../login.php para ser consistente com os outros scripts
header("Location: ../login.php?sucesso=Você saiu do sistema.");
exit();
?>