<?php
namespace Controllers;

use Models\Users;

class UserController {

    public function createUser($lastname, $firstname, $email, $password, $consentement, $creation_date): bool {
        $user = new Users();
        return $user->create(lastname: $lastname, firstname: $firstname, email: $email, password: $password, consentement: $consentement, creation_date: $creation_date);
    }

    public function getUsers(): array {
        $user = new Users();
        return $user->read();
    }

    public function updateUser($id, $lastname, $firstname, $email, $password): bool {
        $user = new Users();
        return $user->update(id: $id, lastname: $lastname, firstname: $firstname, email: $email, password: $password);
    }

    public function deleteUser($id): bool {
        $user = new Users();
        return $user->delete(id: $id);
    }    
}

?>