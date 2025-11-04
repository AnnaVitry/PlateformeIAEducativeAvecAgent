<?php
require_once __DIR__ . '/../App/Config/Autoloader.php';

use App\Config\Autoloader;


Autoloader::register();

// Exemple : charger un contrôleur automatiquement
use App\Controllers\UserController;

$controller = new UserController();
$controller->getUser();
