<?php
namespace App\Controllers;

// require_once __DIR__ . '/../Config/Autoloader.php';

// use App\Config\Autoloader;

// // Autoload de toutes les classes
// Autoloader::register();

require_once __DIR__ . '/../Models/Levels.php';

use App\Models\Levels;
use PDO;
use PDOException;

class LevelsController {
    public $level;

    public function __construct(PDO $db)
    {
        $this->level = new Levels($db);
    }

    public function createUser($description, $level): bool
    {
        return $this->level->create(description: $description, level: $level);
    }

    public function getLevels(): array
    {
        return $this->level->read();
    }

    public function updateUser($id, $description, $level): bool
    {
        return $this->level->update(id: $id, description: $description, level: $level);
    }

    public function deleteUser($id): bool
    {
        return $this->level->delete(id: $id);
    }    
}