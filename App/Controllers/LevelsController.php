<?php
namespace App\Controllers;

require_once __DIR__ . '/../Models/Levels.php';

use App\Models\Levels;

class LevelsController {
    public $level;

    public function __construct() {
        $this->level = new Levels();
    }

    public function createUser($description, $level): bool {
        return $this->level->create(description: $description, level: $level);
    }

    public function getLevels(): array {
        return $this->level->read();
    }

    public function updateUser($id, $description, $level): bool {
        return $this->level->update(id: $id, description: $description, level: $level);
    }

    public function deleteUser($id): bool {
        return $this->level->delete(id: $id);
    }    
}