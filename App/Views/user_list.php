<?php

namespace App\Views;

require_once __DIR__ . '/../App/Config/Autoloader.php';

use App\Config\Database;
use App\Controllers\UsersController;
use App\Config\Autoloader;

// Autoload de toutes les classes
Autoloader::register();

// Connexion à la base de données
$db = new Database();
$pdo = $db->connect(); // retourne ton objet PDO

// $db = new Database();
$UsersController = new UsersController($pdo);
$users = $UsersController->getUser();

