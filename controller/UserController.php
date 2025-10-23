<?php
namespace Controllers;

use Models\Users;

class UserController {

    public function createUser($lastname, $firstname, $email, $password, $consentement, $creation_date) {
        $user = new Users();
        return $user->create($lastname, $firstname, $email, $password, $consentement, $creation_date);
    }

    public function getUsers() {
        $user = new Users();
        return $user->read();
    }

    public function updateUser($id, $lastname, $firstname, $email, $password) {
        $user = new Users();
        return $user->update($id, $lastname, $firstname, $email, $password);
    }

    public function deleteUser($id) {
        $user = new Users();
        return $user->delete($id);
    }    
}

?>