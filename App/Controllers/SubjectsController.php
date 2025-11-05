<?php
namespace App\Models;

require_once __DIR__ . '/../Config/Autoloader.php';

use App\Config\Autoloader;
// // Autoload de toutes les classes
Autoloader::register();

use PDO;
use PDOException;

class Subjects
{
    private $conn;

    public function __construct(PDO $db)
    {
        $this->conn = $db;
    }

    public function create($theme)
    {
        try {
            $sql = "INSERT INTO Subjects (theme) VALUES (:theme)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':theme', $theme);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "❌ Erreur lors de la création du sujet : " . $e->getMessage();
            return false;
        }
    }

    public function getAll()
    {
        try {
            $sql = "SELECT * FROM Subjects ORDER BY id_subject DESC";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "❌ Erreur lors de la récupération des sujets : " . $e->getMessage();
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT * FROM Subjects WHERE id_subject = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "❌ Erreur lors de la récupération du sujet : " . $e->getMessage();
            return null;
        }
    }

    public function update($id, $theme)
    {
        try {
            $sql = "UPDATE Subjects SET theme = :theme WHERE id_subject = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':theme', $theme);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "❌ Erreur lors de la mise à jour du sujet : " . $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM Subjects WHERE id_subject = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "❌ Erreur lors de la suppression du sujet : " . $e->getMessage();
            return false;
        }
    }
}
