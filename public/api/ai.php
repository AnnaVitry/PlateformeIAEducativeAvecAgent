<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_clean();
    echo json_encode(['error' => 'Méthode POST requise']);
    exit;
}

require_once __DIR__ . '/../../App/Config/Autoloader.php';
use App\Config\Autoloader;

// ← FIX : TOUS les use ICI, au top level (pas dans try)
use App\Config\Database;
use App\Controllers\AgentsController;

Autoloader::register();

$rawInput = file_get_contents('php://input');
error_log("Raw input ai.php: " . $rawInput);
$input = json_decode($rawInput, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    ob_clean();
    echo json_encode(['error' => 'JSON invalide: ' . json_last_error_msg()]);
    exit;
}
$message = $input['message'] ?? '';

if (empty($message)) {
    ob_clean();
    echo json_encode(['error' => 'Message vide']);
    exit;
}

try {
    // Pas de use ici – déjà importés
    $db = new Database();
    $pdo = $db->connect();

    $controller = new AgentsController();
    $controller->handleRequest();

} catch (Throwable $e) {
    ob_clean();
    error_log("Erreur ai.php: " . $e->getMessage() . " | Stack: " . $e->getTraceAsString());
    echo json_encode(['error' => 'Erreur interne: ' . $e->getMessage()]);
}
ob_end_flush();
?>