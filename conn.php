<?php
try {
    // Paramètres de connexion MySQL
    $host = 'localhost';
    $dbName = 'sad';
    $username = 'root';
    $password = 'mdp';

    // Connexion au serveur MySQL (sans spécifier encore la base)
    $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la base si elle n'existe pas
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
    $pdo->exec("USE `$dbName`;");

    // Importation du fichier SQL contenant ton MPD
    $sqlFile = __DIR__ . '/database.sql'; // même dossier que ton script PHP
    if (!file_exists($sqlFile)) {
        throw new Exception("Le fichier SQL '$sqlFile' est introuvable dans le dossier : " . __DIR__);
    }

    $sql = file_get_contents($sqlFile);
    $pdo->exec($sql);

    echo "Base de données '$dbName' créée et tables importées avec succès.<br>";

    // Vérification : afficher les tables créées
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tables créées : " . implode(', ', $tables);

} catch (PDOException $exception) {
    echo "Erreur PDO : " . $exception->getMessage();
} catch (Exception $exception) {
    echo "Erreur : " . $exception->getMessage();
}
?>
