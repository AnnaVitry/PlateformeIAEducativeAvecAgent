<?php
namespace App\Services;

class AiClient
{
    private string $apiUrl;
    private string $apiKey;

    public function __construct(string $apiKey, string $apiUrl = 'https://api.groq.com/openai/v1/chat/completions')
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Envoie un message au service IA et retourne la réponse décodée (array) ou lance une exception.
     * @param string $message
     * @param array $options
     * @return array
     * @throws \RuntimeException
     */
    public function sendMessage(string $message, array $options = []): array
{
    $payload = array_merge([
        'model' => $options['model'] ?? 'llama-3.1-8b-instant',
        'messages' => [
            ['role' => 'system', 'content' => $options['system'] ?? "Tu es un assistant pédagogique qui aide les élèves de 6e."],
            ['role' => 'user', 'content' => $message]
        ]
    ], $options['extra'] ?? []);

    $ch = curl_init($this->apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $this->apiKey
    ]);

    // Robustesse : timeouts
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);

    // FIX SSL : Désactive vérif pour dev (réactive en prod avec CA bundle)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // ← AJOUT ICI
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // ← Optionnel, pour host

    $response = curl_exec($ch);

    if ($response === false) {
        $err = curl_error($ch);
        $errno = curl_errno($ch);
        curl_close($ch);
        throw new \RuntimeException("cURL error ({$errno}): {$err}");
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode < 200 || $httpCode >= 300) {
        $decodedErr = json_decode($response, true);
        $msg = $decodedErr['error']['message'] ?? substr($response, 0, 500);
        throw new \RuntimeException("API returned HTTP {$httpCode}: {$msg}");
    }

    $decoded = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new \RuntimeException('Invalid JSON response from AI service: ' . json_last_error_msg());
    }

    return $decoded;
}
}