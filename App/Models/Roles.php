<?php

namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';

use App\Config\Database;

class Roles {

    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($role) {
        $sql = "INSERT INTO Roles (role) VALUES (:role)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function read(){
        $sql = "SELECT * FROM Roles";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, $role){
        $sql = "UPDATE Roles SET role = :role WHERE id_role = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql ="DELETE FROM Roles WHERE id_role = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>