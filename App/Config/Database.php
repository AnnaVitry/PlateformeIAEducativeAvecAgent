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
    }

    // Connexion à la base de données
    public function connect()
    {
       try {
            // Connexion initiale au serveur MySQL (sans base)
            $this->pdo = new PDO(
                "mysql:host=" . DB_HOST . ";charset=utf8mb4",
                DB_USER,
                DB_PASS
            );
            $this->pdo->exec("USE `" . DB_NAME . "`;");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion au serveur MySQL réussie. Base de données '". DB_NAME ."' sélectionnée.<br>";
            return $this->pdo;
        } catch (PDOException $e) {
            echo "❌ Erreur de connexion au serveur MySQL : " . $e->getMessage();
        }
    }
    // Création de la base de données si elle n'existe pas
    public function createDatabase()
    {
        try {
            $this->connect(); // Connexion initiale pour exécuter les commandes SQL
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
            echo "Base de données '" . DB_NAME . "' a bien été créer.\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la création de la base de données : " . $e->getMessage();
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
            echo "Tables importées avec succès.\n";
        } catch (PDOException $e) {
            echo "Erreur lors de l'importation du fichier SQL : " . $e->getMessage();
        }
    }

    // Vérification des tables créées
    public function showTables()
    {
        try {
            $tables = $this->pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
            echo "Tables créées : " . implode(', ', $tables) . "\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des tables : " . $e->getMessage();
        }
    }
}

// $db = new Database();
// $db->connect();
// $db->importSQL(__DIR__ . "/database.sql");

