<?php
namespace App\config;

class Autoloader
{
    public static function register()
    {
        // Enregistre la méthode autoload() comme autoloader
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($class)
    {
        // Remplace les \ par / pour faire un vrai chemin de fichier
        $class = str_replace('\\', '/', $class);

        // Base du projet (racine du dossier "App")
        $baseDir = __DIR__ . '/../..';

        // Construit le chemin complet du fichier à inclure
        $file = $baseDir . '/' . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
        } else {
            // Optionnel : message utile en cas d'erreur
            error_log("⚠️ Classe non trouvée : $file");
        }
    }
}
