<?php
// public/index.php

require_once __DIR__ . '/../App/Config/Autoloader.php';

use App\Config\Autoloader;
use App\Controllers\UsersController;
use App\Config\Database;

Autoloader::register();

// Connection à la DB
$db = new Database();
$pdo = $db->connect();

// Simple routing via paramètre GET (ex: ?page=login)
$page = $_GET['page'] ?? 'home';

// Contrôleur selon la page
switch ($page) {
    case 'login':
        $controller = new UsersController($pdo);
        $controller->login($_POST);
        break;
        
    case 'register':
        $controller = new UsersController($pdo);
        $controller->register($_POST);
        break;
        
    // case 'dashboard':
    //     $controller = new UsersController($pdo);
    //     $controller->dashboard();
    //     break;
        
    default:
        include __DIR__ . '/../App/Views/home.php';
        break;
}
