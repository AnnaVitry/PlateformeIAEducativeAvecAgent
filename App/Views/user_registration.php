<?php

namespace App\Views;

require_once __DIR__ . '/../Controllers/UserController.php';

use App\Controllers\UserController;


// Traiter le formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController = new UserController();    
    $lastname = $_POST['lastname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $consentement = isset($_POST['consentement']) ? 1 : 0;
    $creation_date = date('Y-m-d H:i:s');
    
    $result = $userController->createUser(
        $lastname, 
        $firstname, 
        $email, 
        $password, 
        $consentement, 
        $creation_date
    );
    
    if ($result) {
        echo "<p style='color: green;'>Inscription réussie !</p>";
    } else {
        echo "<p style='color: red;'>Erreur lors de l'inscription.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../App/public/css/inscription.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Inscription</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo">🎓 EduAI</div>
            <ul class="nav-links">
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#matieres">Matières</a></li>
                <li><a href="#fonctionnalites">Fonctionnalités</a></li>
                <li><a href="../App/Views/user_registration.php" class="btn-primary">Commencer</a></li>
            </ul>
        </nav>
    </header>
    <h1>Inscription</h1>
    
    <form method="POST" action="">
        <div>
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        
        <div>
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="consentement" required>
                J'accepte les conditions d'utilisation
            </label>
        </div>
        
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>