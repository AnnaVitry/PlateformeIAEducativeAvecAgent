<?php
namespace App\Controllers; // On inclut le modèle Agent

require_once __DIR__ . '/../Models/Agents.php';// Inclure le modèle Agent

use App\Models\Agents;// Utiliser le modèle Agent

class AgentsController {

    public function handleRequest()
    {
        // Récupère le message envoyé depuis le front
        $input = json_decode(file_get_contents("php://input"), true);
        $message = $input["message"] ?? '';

        // Clé API Groq (à mettre dans un fichier .env ou config sécurisé)
        $apiKey = GROQ_API_KEY;

        // Prépare la requête
        $data = [
            "model" => "llama-3.1-8b-instant",
            "messages" => [
                ["role" => "system", "content" => "Tu es un assistant pédagogique qui aide les élèves de 6e."],
                ["role" => "user", "content" => $message]
            ]
        ];

        // Appel API Groq
        $ch = curl_init("https://api.groq.com/openai/v1/chat/completions"); /* Ici on stock la connexion*/
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); /*Configure cURL pour retourner la réponse au lieu de l'afficher directement*/
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $apiKey", /*Ajoute l'en-tête d'autorisation avec la clé API*/
            "Content-Type: application/json" /*Spécifie que le contenu est au format JSON*/
        ]);
        curl_setopt($ch, CURLOPT_POST, true);/*Indique que c'est une requête POST*/
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));/*Encode les données en JSON et les envoie dans le corps de la requête*/

        $response = curl_exec($ch);/*Exécute la requête et stocke la réponse*/
        curl_close($ch);/*Ferme la session cURL*/

        header('Content-Type: application/json');/*Définit l'en-tête de la réponse comme JSON*/
        echo $response;/*Renvoie la réponse de l'API au client*/
    }

}