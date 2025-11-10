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
$isRegister = False;
$inscription = Null;
// Traiter le formulaire si soumis

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $_POST['Consentment'];
    $UsersController = new UsersController($pdo);    
    $lastname = $_POST['lastname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $consentement = isset($_POST['consentement']) ? 1 : 0;
    
    $isRegister = $UsersController->createUser(
        $lastname, 
        $firstname, 
        $email, 
        $password, 
        $consentement, 
    );
    
    if ($isRegister) {
        $inscription = "<p style='color: green;'>Inscription réussie !</p>";
    } else {
        $inscription = "<p style='color: red;'>Erreur lors de l'inscription.</p>";
    }
}

if (isset($inscription)) {
    echo "<span>" . $inscription . "</span>";
}

if (isset($isRegister) && !$isRegister) {
?>
<form class="box" method="POST" action="./register.php">
    <h1 class="box-title">S'inscrire</h1>
	<input type="text" class="box-input" id="lasttname" name="lasttname" placeholder="Nom" required />
    <input type="text" class="box-input" id="firstname" name="firstname" placeholder="Prénom" required>
    <input type="text" class="box-input" id="email" name="email" placeholder="Email" required />
    <input type="password" class="box-input" id="password" name="password" placeholder="Mot de passe" required />
    <input type="hidden" id="consentement" name="consentment" value="0" />
    <input type="checkbox" id="consentement" name="consentment" value="1" /><label for="consentement"> consentement</label>
    <!-- <input type="checkbox" id="consentement" name="consentement" required /><label for="consentement"> consentement</label> -->
    <input type="submit" name="submit" value="S'inscrire" class="box-button" />
</form>
?>
<script>
    document.addEventListener('DOMContentLoaded', e => {
        for (let checkbox of document.querySelectorAll('input[type=checkbox]')) {
            checkbox.value = checkbox.checked ? 1 : 0;
            checkbox.addEventListener('change', e => {
                e.target.value = e.target.checked ? 1 : 0;
            });
        }
    });
</script>
<?php 
}
if (isset($isRegister) && $isRegister) {
    echo 
    '<script>
        setTimeout(function() {
            window.location.href = "dashboard.php";
        }, 2000);
    </script>'; 
    // echo "<script>" .  "redirection vers dashboard avec timer 5sec" . "</script>";
}

    