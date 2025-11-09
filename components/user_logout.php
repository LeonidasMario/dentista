<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'connect.php';


setcookie('user_id', '', time() - 3600, '/'); 

header('Location: ../login.php');
exit;
?>