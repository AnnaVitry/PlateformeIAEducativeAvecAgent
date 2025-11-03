<?php

namespace App\Models;

require_once __DIR__ . '/../Config/Database.php';

use App\Config\Database;

class Levels {

    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function create($description, $level) {
        $sql = "INSERT INTO Levels (description, level) 
        VALUES (:description, :level)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':level', $level);
        return $stmt->execute();
    }

    public function read(){
        $sql = "SELECT * FROM Levels";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, $description, $level){
        $sql = "UPDATE Levels SET description = :description, level = :level WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql ="DELETE FROM Levels WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>