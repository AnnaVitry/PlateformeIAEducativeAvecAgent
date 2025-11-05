<?php
namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct()
    {
        require_once __DIR__ . "/config.php";
        try {
        // Connexion initiale au serveur MySQL (sans base)
            $this->pdo = new PDO(
                "mysql:host=" . DB_HOST . ";charset=utf8mb4",
                DB_USER,
                DB_PASS
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("Connexion au serveur MySQL réussie. Base de données");
        } catch (PDOException $e) {
            error_log("Erreur de connexion au serveur MySQL : " . $e->getMessage());
        }
    }

    // Connexion à la base de données
    public function connect($useDb = true) {  // Nouveau param : $useDb = false pour création sans USE
    try {
        // Connexion sans DB sélectionnée
        $dsn = "mysql:host=" . DB_HOST . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

        error_log("Connexion au serveur MySQL réussie.");  // Log au lieu d'echo

        if ($useDb && !empty(DB_NAME)) {
            $this->pdo->exec("USE `" . DB_NAME . "`;");
            error_log("Base de données '" . DB_NAME . "' sélectionnée.");
        }

        return $this->pdo;
    } catch (PDOException $e) {
        error_log("Erreur PDO connect: " . $e->getMessage());
        if (str_contains($e->getMessage(), 'Unknown database') && $useDb) {
            error_log("⚠️ Base '" . DB_NAME . "' introuvable, tentative de création...");
            $this->createDatabase();  // Appel unique, sans boucle
            return $this->connect($useDb);  // Re-tente après création (1 appel max)
        }
        throw $e;  // Relance si autre erreur
    }
}

public function createDatabase() {
    try {
        // Connexion SANS USE DB (param false pour éviter récursion)
        $dsn = "mysql:host=" . DB_HOST . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdoTemp = new PDO($dsn, DB_USER, DB_PASS, $options);  // PDO temp sans DB

        // Crée la DB si pas existante
        $pdoTemp->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

        error_log("✅ Base de données '" . DB_NAME . "' créée avec succès.");

        // Import SQL si fichier existe
        $this->importSQL($pdoTemp);  // Passe PDO temp

        $pdoTemp = null;  // Ferme temp
    } catch (PDOException $e) {
        error_log("Erreur création DB: " . $e->getMessage());
        throw $e;
    }
}

    // Importer le fichier SQL
    public function importSQL()
    {
        $sqlFile = __DIR__ ."/database.sql";
        try {
            if (!file_exists($sqlFile)) {
                throw new PDOException("Le fichier SQL {$sqlFile} est introuvable.");
            }
            // Lire les commandes SQL et les exécuter
            $sqlCommands = file_get_contents($sqlFile);
            $this->pdo->exec($sqlCommands);
            error_log("Fichier SQL importé avec succès.");
        } catch (PDOException $e) {
            error_log("Erreur lors de l'importation du fichier SQL : " . $e->getMessage());
        }
    }

    // Vérification des tables créées
    public function showTables()
    {
        try {
            $tables = $this->pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
            error_log("Tables dans la base de données '" . DB_NAME . "': " . implode(", ", $tables));
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des tables : " . $e->getMessage());
        }
    }
}

// $db = new Database();
// $db->connect();
// $db->importSQL(__DIR__ . "/database.sql");

