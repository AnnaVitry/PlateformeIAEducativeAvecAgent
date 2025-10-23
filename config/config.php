<?php
// Fichier config.php

$dotenv_path = __DIR__ . '/.env';

if (!file_exists($dotenv_path)) {
    die("Erreur: Le fichier .env est introuvable. Veuillez le créer et le remplir.\n");
}


// Lecture et parsing manuel du fichier .env
$lines = file($dotenv_path, FILE_SKIP_EMPTY_LINES);
$config = [];

foreach ($lines as $line) {
    $line = trim($line);
    // Ignore les commentaires et les lignes vides
    if (empty($line) || strpos($line, '#') === 0) {
        continue;
    }

    // Analyse la ligne au format KEY=VALUE
    list($key, $value) = explode('=', $line, 2);
    $config[trim($key)] = trim($value);
}

// Définition des constantes pour un accès facile
define('DB_HOST', $config['DB_HOST'] ?? 'localhost');
define('DB_NAME', $config['DB_NAME'] ?? '');// Ceci '' est recommandé par défaut.
define('DB_USER', $config['DB_USER'] ?? '');// SiDB_<...> n'est pas dans le fichier .env,
define('DB_PASS', $config['DB_PASS'] ?? '');// le script échoue en toute sécurité lors de la tentative de connexion PDO
?>