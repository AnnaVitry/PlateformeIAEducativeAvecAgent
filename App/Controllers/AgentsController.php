<?php
namespace App\Controllers;

require_once __DIR__ . '/../Config/Autoloader.php';

use App\Config\Autoloader;
use App\Config;

// Autoload de toutes les classes
Autoloader::register();
use App\Models\Agents;
use App\Services\AiClient;
// echo API_KEY;
class AgentsController {

    public function handleRequest()
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents('php://input'), true);
        $message = $input['message'] ?? null;

        if (empty($message)) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing message parameter']);
            return;
        }

        // Utilise le client centralisé
        try {
            $apiKey = defined('API_KEY') ? API_KEY : '';
            if (empty($apiKey)) {
                throw new \RuntimeException('API_KEY is not configured');
            }

            $client = new AiClient($apiKey);
            $resp = $client->sendMessage($message);

            // Normaliser la réponse vers le front (exemple pour structure "choices" similaire)
            // On renvoie directement la réponse décodée pour que le front puisse l'afficher.
            echo json_encode($resp);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

}