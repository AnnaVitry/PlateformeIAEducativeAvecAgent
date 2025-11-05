<?php

namespace App\Models;

require_once __DIR__ . '/../Config/Autoloader.php';

use App\Config\Autoloader;
// // Autoload de toutes les classes
Autoloader::register();

require_once __DIR__ . '/../Config/Database.php';

use App\Config\Database;
use PDO;
use PDOException;

class Levels {

    private $conn;
    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function create($description, $level)
    {
        $sql = "INSERT INTO Levels (description, level) 
        VALUES (:description, :level)";
        $stmt =  $this->conn->prepare($sql);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':level', $level);
        return $stmt->execute();
    }

    public function read()
    {
        $sql = "SELECT * FROM Levels";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $description, $level)
    {
        $sql = "UPDATE Levels SET description = :description, level = :level WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql ="DELETE FROM Levels WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

?>