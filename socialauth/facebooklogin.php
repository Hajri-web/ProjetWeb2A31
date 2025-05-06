<?php
session_start();
require_once __DIR__ . '/../controller/SocialAuthController.php';

$controller = new SocialAuthController();
$controller->facebookLogin();
?>
