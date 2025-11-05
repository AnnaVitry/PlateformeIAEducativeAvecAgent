<?php
namespace App\Controllers;

require_once __DIR__ . '/../Config/Autoloader.php';
use App\Config\Autoloader;

// Autoload
Autoloader::register();

use App\Services\AiClient;

class AgentsController {
    public function handleRequest() {
    // Headers déjà en haut d'ai.php, OK

    $input = json_decode(file_get_contents('php://input'), true);
    $message = $input['message'] ?? null;

    if (empty($message)) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing message parameter']);
        return;
    }

    session_start();

    try {
        $apiKey = defined('API_KEY') ? API_KEY : '';
        if (empty($apiKey)) {
            throw new \RuntimeException('API_KEY is not configured');
        }

        $client = new AiClient($apiKey);
        $rawResp = $client->sendMessage($message);

        // NORMALISATION CRITIQUE : Extrait le texte reply
        $reply = '';
        if (is_array($rawResp) && isset($rawResp['choices'][0]['message']['content'])) {
            $reply = trim($rawResp['choices'][0]['message']['content']);
        } elseif (is_string($rawResp)) {
            $reply = trim($rawResp);
        } else {
            throw new \RuntimeException('Réponse AiClient invalide');
        }

        // Session
        if (!isset($_SESSION['chat_messages'])) {
            $_SESSION['chat_messages'] = [];
        }
        $_SESSION['chat_messages'][] = ['sender' => 'user', 'text' => $message];
        $_SESSION['chat_messages'][] = ['sender' => 'assistant', 'text' => $reply];

        // Echo JSON pour JS
        echo json_encode(['reply' => $reply]);

    } catch (\Throwable $e) {
        error_log("AgentsController error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }

}

    private function normalizeResponse($rawResp, $message = '') {
        if (is_string($rawResp)) {
            // Si raw string (ex. Llama direct), traite comme reply
            return ['reply' => trim($rawResp)];
        }
        if (is_array($rawResp) && isset($rawResp['choices'][0]['message']['content'])) {
            // Structure OpenAI-like
            return ['reply' => $rawResp['choices'][0]['message']['content']];
        }
        // Fallback
        return ['reply' => 'Réponse IA par défaut: Magie pour "' . $message . '" ! 🧙‍♂️'];
    }
}