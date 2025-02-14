<?php
session_start();
session_destroy();
header("Location: /templates/tela-login.php");
exit;
?>
