<?php

namespace App\Models;

use App\Config\Database;

class Agents {

    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }
// id, prompt historic, id_subject, id_level
    public function create($id_subject, $id_level) {
        $sql = "INSERT INTO Agents (id_subject, id_level) 
        VALUES (:id_subject, :id_level)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->bindParam(':id_subject', $id_subject);
        $stmt->bindParam(':id_level',$id_level);
        return $stmt->execute();
    }

    public function read(){
        $sql = "SELECT * FROM Agents";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function update($id, $prompt,$historic){
        $sql = "UPDATE Agents SET prompt = :prompt, historic = :historic WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':prompt', $prompt);
        $stmt->bindParam(':historic',$historic);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql ="DELETE FROM Agents WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>