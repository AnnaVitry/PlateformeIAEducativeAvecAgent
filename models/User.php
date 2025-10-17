<?php

namespace Models;

use config\conn;

class User {

    private $conn;

    public function __construct()
    {
        $database = new conn();
        $this->conn = $database->connect();
    }

    public function create($lastname, $firstname, $email, $consentement, $creation_date) {
        $sql = "INSERT INTO Users (lastname, firstname, email, consentement, creation_date) VALUES (:lastname, :firstname, :email)";
    }
}