<?php
namespace App\Controllers;

use App\Models\Levels;

class LevelsController {

    public function createUser($description, $level): bool {
        $user = new Levels();
        return $user->create(description: $description, level: $level);
    }

    public function getLevels(): array {
        $user = new Levels();
        return $user->read();
    }

    public function updateUser($id, $description, $level): bool {
        $user = new Levels();
        return $user->update(id: $id, description: $description, level: $level);
    }

    public function deleteUser($id): bool {
        $user = new Levels();
        return $user->delete(id: $id);
    }    
}

?>