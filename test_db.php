<?php
require_once 'config/database.php';
require_once 'models/Profile.php';
$profileModel = new Profile($pdo);
$profileData = $profileModel->getProfile();
header('Content-Type: application/json');
echo json_encode($profileData, JSON_PRETTY_PRINT);
?>
