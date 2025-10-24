<?php
namespace App\Controllers;

use App\Models\Users;

class UserController {
    public $user;

    public function __construct() {
        $this->user = new Users();
    }
    public function createUser($lastname, $firstname, $email, $password, $consentement, $creation_date): bool {
        return $this->user->create(lastname: $lastname, firstname: $firstname, email: $email, password: $password, consentement: $consentement, creation_date: $creation_date);
    }

    public function getUser(): array {
        return $this->user->read();
    }

    public function updateUser($id, $lastname, $firstname, $email, $password): bool {
        return $this->user->update(id: $id, lastname: $lastname, firstname: $firstname, email: $email, password: $password);
    }

    public function deleteUser($id): bool {
        return $this->user->delete(id: $id);
    }    
}

?>