<?php
// logout.php - Arquivo responsável por funcionalidade específica do sistema
session_start();
session_destroy();
header("Location: login.php");
exit;
