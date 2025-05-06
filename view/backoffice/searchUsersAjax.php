<?php
include_once(__DIR__ . '/../../controller/usercontroller.php');
header('Content-Type: application/json; charset=UTF-8');

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($search === '') {
    echo json_encode([]);
    exit;
}

$userController = new UserController();
$results = $userController->searchUsers($search);
echo json_encode($results);
