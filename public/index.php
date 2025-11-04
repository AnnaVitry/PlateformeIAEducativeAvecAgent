<?php
require_once __DIR__ . '/../App/Config/Autoloader.php';

use App\Config\Autoloader;
use App\Config\Database;
use App\Controllers\UsersController;

// Autoload de toutes les classes
Autoloader::register();

// Connexion à la base de données
$db = new Database();
$pdo = $db->connect(); // retourne ton objet PDO

// On passe $pdo au contrôleur
$controller = new UsersController($pdo);

// Exemple d’appel d’une méthode du contrôleur
$controller->getUser();
