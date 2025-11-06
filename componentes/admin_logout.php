<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'connect.php';

setcookie('admin_id', '', time() - 3600, '/'); // Expira o cookie

header('Location: ../admin/login.php');
exit;
?>
