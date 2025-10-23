<?php
// autoload.php (à la racine)

spl_autoload_register(function ($class) {
    // Remplacer les backslashes par des slashes
    $class = str_replace('\\', '/', $class);
    
    // Chemin du fichier
    $file = __DIR__ . '/' . $class . '.php';
    
    // Inclure si le fichier existe
    if (file_exists($file)) {
        require_once $file;
    }
});
?>