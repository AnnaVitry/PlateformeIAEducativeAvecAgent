<?php
// Endpoint minimal pour proxy vers le contrôleur d'agents/IA
// Placez ce fichier dans le répertoire `public/` (web root) et appelez-le via fetch('/api/ai.php')

// Autoriser les petites requêtes AJAX depuis le front (adapter CORS si nécessaire)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/../../App/Config/config.php';
require_once __DIR__ . '/../../App/Controllers/AgentsController.php';

// require_once __DIR__ . '/../Config/Autoloader.php';

// use App\Config\Autoloader;
// // Autoload de toutes les classes
// Autoloader::register();

use App\Controllers\AgentsController;

$controller = new AgentsController();
$controller->handleRequest();
