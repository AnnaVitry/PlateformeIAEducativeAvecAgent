<?php

// Load the configuration constants from .env
require_once 'config.php';

$SQL_FILE = 'database.sql'; 

try {
    // Establishing the PDO connection using the constants
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS // This password comes directly from your .env file
    );
    // Set error mode to throw exceptions on failure (best practice)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion à la base de données '" . DB_NAME . "' réussie.\n";

    // --- Execution of the Schema (unchanged) ---
    if (!file_exists($SQL_FILE)) {
        die("Erreur : Le fichier SQL '$SQL_FILE' est introuvable.\n");
    }

    $sql_commands = file_get_contents($SQL_FILE);
    $pdo->exec($sql_commands);

        echo "Base de données '". DB_NAME ."' créée et tables importées avec succès.<br>";

    // Vérification : afficher les tables créées
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables créées : " . implode(', ', $tables);

} catch (PDOException $exception) {
    echo "Erreur PDO : " . $exception->getMessage();
} catch (Exception $exception) {
    echo "Erreur : " . $exception->getMessage();
}

?>