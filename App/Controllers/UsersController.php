<?php
namespace App\Controllers;

require_once __DIR__ . '/../Config/Autoloader.php';

use App\Config\Autoloader;

Autoloader::register();

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
    
    public function login($email, $password) {
    $user = $this->user->findByEmail($email);
    if ($user && password_verify($password, $user['password'])) return $user;
    return false;
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
}