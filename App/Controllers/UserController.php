<?php
namespace App\Controllers;

use App\Models\User;

class UserController {

    public function createUser($lastname, $firstname, $email, $password, $consentement, $creation_date): bool {
        $user = new User();
        return $user->create(lastname: $lastname, firstname: $firstname, email: $email, password: $password, consentement: $consentement, creation_date: $creation_date);
    }

    public function getUser(): array {
        $user = new User();
        return $user->read();
    }

    public function updateUser($id, $lastname, $firstname, $email, $password): bool {
        $user = new User();
        return $user->update(id: $id, lastname: $lastname, firstname: $firstname, email: $email, password: $password);
    }

    public function deleteUser($id): bool {
        $user = new User();
        return $user->delete(id: $id);
    }    
}

?>