<?php

namespace App\Controllers;

require_once __DIR__ . '/../Models/Roles.php';

use App\Models\Roles;
use PDO;
use PDOException;

class RolesController
{
    private $role;

    public function __construct(PDO $db)
    {
        $this->role = new Roles($db);
    }

    public function createRoles($roleName)
    {
        return $this->role->create($roleName);
    }

    public function getRoles()
    {
        return $this->role->read();
    }

    public function updateRoles($id, $roleName)
    {
        return $this->role->update($id, $roleName);
    }

    public function deleteRole($id)
    {
        return $this->role->delete($id);
    }
}