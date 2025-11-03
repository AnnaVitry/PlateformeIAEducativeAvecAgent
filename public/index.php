<?php
require_once __DIR__ . '/../App/config/Autoloader.php';

use App\config\Autoloader;

Autoloader::register();

// Exemple : charger un contrôleur automatiquement
use App\Controllers\UserController;

$controller = new UserController();
$controller->index(); // ou autre méthode
