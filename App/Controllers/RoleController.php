<?php

namespace App\Controllers;

require_once __DIR__ . '/../Models/Roles.php';

use App\Models\Roles;

class RoleController
{
    private $role;

    public function __construct()
    {
        $this->role = new Roles();
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