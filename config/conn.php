<?php

// Charge les configuration du fichier .env
require_once 'config.php';

$SQL_FILE = 'database.sql'; 

try {
    // Establishing the PDO connection using the constants
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";charset=utf8",
        DB_USER,
        DB_PASS
    );
    // Paramétre le mode error pour lancé une exception en cas d'echec
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la base si elle n'existe pas
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME. "` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
    $pdo->exec("USE `" . DB_NAME. "`;");

    echo "Connexion à la base de données '" . DB_NAME . "' réussie.\n";

    // Importation du fichier SQL contenant ton MPD
    if (!file_exists($SQL_FILE)) {
        throw new Exception("Le fichier SQL " . $SQL_FILE . " est introuvable dans le dossier : " . __DIR__);
    }
    
    // Execution de database.sql
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