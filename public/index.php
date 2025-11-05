<?php
require_once __DIR__ . '/../App/Config/Autoloader.php';

use App\Config\Autoloader;
use App\Config\Database;
use App\Controllers\UsersController;

Autoloader::register();

$db = new Database();
$pdo = $db->connect();
$controller = new UsersController($pdo);

$route = $_GET['route'] ?? 'home';

switch ($route) {
    case 'login':
        include __DIR__ . '/Views/login.php';
        break;
        
    case 'connexion':
        if ($_POST) {
            // TODO: Vérif email/password
        }
        break;
        
    case 'dashboard':
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?route=login');
            exit;
        }
        $users = $controller->getUser();
        // CORRECTION : Charge depuis public/, pas Views/
        include __DIR__ . '/dashboard.php';
        break;

    case 'logout':
        session_start();
        session_destroy();
        header('Location: ?route=login');
        exit;
        break;
        
    default:
        header('Location: ?route=login');
        break;
}