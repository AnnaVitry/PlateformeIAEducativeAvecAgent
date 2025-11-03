<?php
// <?php
namespace App\Models;

// class Users
// {
//     public function __construct()
//     {
//         echo "Classe Users chargée !<br>";
//     }
// }

require_once __DIR__ . '/../Config/Database.php';

use App\Config\Database;

class Users {

    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($lastname, $firstname, $email, $password, $consentement)
    {
        $sql = "INSERT INTO Users (lastname, firstname, email, password, consentement)
                VALUES (:lastname, :firstname, :email, :password, :consentement)";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':consentement', $consentement);

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