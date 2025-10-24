<?php

namespace App\Models;

use App\Config\Database;

class Users {

    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($lastname, $firstname, $email, $password, $consentement, $creation_date) {
        $sql = "INSERT INTO Users (lastname, firstname, email, password, consentement, creation_date) 
        VALUES (:lastname, :firstname, :email, :password, :consentement, :creation_date)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':consentement', $consentement);
        $stmt->bindParam(':creation_date', $creation_date);
        return $stmt->execute();
    }

    public function read(){
        $sql = "SELECT * FROM Users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, $lastname, $firstname, $email, $password){
        $sql = "UPDATE Users SET lastname = :lastname, firstname = :firstname, email =:email, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql ="DELETE FROM Users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>