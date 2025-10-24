<?php
namespace App\Config;

require_once 'App/config.php';

use PDO;
use PDOException;

class Database
{
    private $pdo;

    public function __construct()
    {
        // On n'a plus besoin de charger manuellement les variables d'environnement
        // car elles sont déjà définies par config.php
    }

    // Connexion à la base de données
    public function connect()
    {
        try {
            // Connexion PDO en utilisant les constantes définies dans config.php
            $this->pdo = new PDO(
                "postgres:host=" . DB_HOST . ";charset=utf8",
                DB_USER,
                DB_PASS
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion à la base de données réussie.\n";
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    }

    // Création de la base de données si elle n'existe pas
    public function createDatabase()
    {
        try {
            $this->connect(); // Connexion initiale pour exécuter les commandes SQL
            $this->pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
            $this->pdo->exec("USE `" . DB_NAME . "`;");
            echo "Base de données '" . DB_NAME . "' créée avec succès.\n";
        } catch (PDOException $e) {
            echo "Erreur lors de la création de la base de données : " . $e->getMessage();
        }
    }

    // Importer le fichier SQL
    public function importSQL($sqlFile)
    {
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

$db = new Database();
$db->connect();
?>
