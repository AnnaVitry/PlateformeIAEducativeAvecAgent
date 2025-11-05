<?php

namespace App\Views;

require_once __DIR__ . '/../Config/Autoloader.php';

use App\Controllers\UsersController;
use App\Config\Autoloader;
use App\Config\Database;

// Autoload de toutes les classes
Autoloader::register();

// Connexion à la base de données
$db = new Database();
$pdo = $db->connect(); // retourne ton objet PDO

// Traiter le formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $UsersController = new UsersController($pdo);    
    $email = $_GET['email'] ?? '';
    
    $result = $UsersController->getUserByEmail(
    $email, 
    );
}
?>

<!-- <head>
    <link rel="stylesheet" href="../../public/css/style.css">
</head> -->

<!-- <main class="login-container"> -->
    <h2>Connexion</h2>
    
    <form action="./login.php" method="GET" class="login-form">
        
        <label for="email">Adresse Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        
        <button type="submit" class="btn-primary">Se Connecter</button>
        
        <p class="register-link">
            Pas encore de compte ? <a href="./register.ph">S'inscrire ici</a>
        </p>

        <button type="submit" class="btn-primary">Connexion Admin</button>
    </form>
<!-- </main> -->
