<?php
require_once 'app/controllers/AuthController.php';

$ruta = $_GET['ruta'] ?? '';

$controller = new AuthController();

switch ($ruta) {
    case 'login':
        $controller->login();
        break;
    case 'register':
        $controller->register();
        break;
    default:
        header("Location: index.php");
        exit();
}