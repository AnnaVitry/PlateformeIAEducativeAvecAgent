<?php
require_once __DIR__ . '/../App/Config/Autoloader.php';

use App\Config\Database;
use App\Models\Roles;
use App\Models\Levels;
use App\Models\Subjects;
use App\Config\Autoloader;

// Autoload de toutes les classes
Autoloader::register();
// initialisation de DB
$db = new Database();

// Initialisation de la base de données, construct connect de base
$pdo = $db->connect(); // Selectionne la Base de Données, et le Créer si elle n'éxiste pas
$db->importSQL(); // Exécute le fichier sql pour créer les tables
$db->showTables(); // (Optionnel) Affiche les tables crées

// Initialisation des classes utilisées
$role = new Roles( $pdo);
$levels = new Levels($pdo);
$subjects = new Subjects($pdo);

// Ajout de Roles dans la table Roles
$role->create("student");
$role->create("admin");

// Ajout de Niveaux (Levels)
$levels->create(Null, "6éme");
$levels->create(Null, "5éme");
$levels->create(Null, "4éme");
$levels->create(Null, "3éme");
$levels->create(Null, "2nd");
$levels->create(Null, "1ére");
$levels->create(Null, "Terminale");

// Ajout de Sujets (Subjects)
$subjects->create("Français");
$subjects->create("Mathématiques");
$subjects->create("Anglais");
$subjects->create("Allemand");
$subjects->create("Sciences de la Vie et de la Terre");
$subjects->create("Physique-Chimie");
$subjects->create("Histoire");
$subjects->create("Géographie");
$subjects->create("Philosophie");
$subjects->create("Éducation Civique et Sociale");

echo "✅ Données initialisées avec succès.";