<?php
namespace App\Controllers;

// require_once __DIR__ . '/../Config/Autoloader.php';

// use App\Config\Autoloader;
// // Autoload de toutes les classes
// Autoloader::register();

// Chemin relatif depuis le dossier Controllers
require_once __DIR__ . '/../Models/Users.php';

use App\Models\Users;
use PDO;
use PDOException;
class UsersController {
    public $user;

    public function __construct(PDO $db)
    {
        $this->user = new Users($db);
    }

    public function createUser($lastname, $firstname, $email, $password, $consentement): bool
    {
        return $this->user->create(lastname: $lastname, firstname: $firstname, email: $email, password: $password, consentement: $consentement);
    }

    public function getUser(): array
    {
        return $this->user->read();
    }

    public function updateUser($id, $lastname, $firstname, $email, $password): bool
    {
        return $this->user->update(id: $id, lastname: $lastname, firstname: $firstname, email: $email, password: $password);
    }

    public function deleteUser($id): bool
    {
        return $this->user->delete(id: $id);
    }

    public function getUserByEmail($email): array
    {
        return $this->user->findByEmail($email);
    }

    public function register($json_form)
    {
        $lastname = $json_form['lastname'] ?? null;
        $firstname = $json_form['firstname'] ?? null;
        $email = $json_form['email'] ?? null;
        $password = $json_form['password'] ?? null;
        $consentement = $json_form['consentment'] ?? null;

        $this->createUser($lastname, $firstname, $email, $password, $consentement);
    }

    public function login($json_form)
    {
        $email = $json_form['email'] ?? null;
        $password = $json_form['password'] ?? null;

        if (!$email || !$password) {
            // Retourner une erreur si les champs sont vides
            echo "Veuillez remplir tous les champs.";
            return;
        }
        // Vérifier si un utilisateur existe avec cet email
        $user = $this->getUserByEmail($email);
        
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        

        if (!$user) {
            echo "Aucun utilisateur trouvé avec cet email.";
            return;
        }
        if ($user['password'] == $hashedPassword) {
            // bon login envoyer vers Dashboard
            $this->user = '' ; // fonction qui lui reatribue l'objet user qui s'est connecté
        }
        elseif ($user != True ) {
            // Password ou Email éronné page login essaye encore
        }
        else {
            // Password ou Email éronné page login essaye encore
        }
    }
}