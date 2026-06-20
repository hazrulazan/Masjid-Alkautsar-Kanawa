<?php
// admin/logout.php
session_start();
require_once '../config/database.php';
require_once '../models/Auth.php';

$auth = new Auth($pdo);
$auth->logout();

header("Location: login.php");
exit;
?>
