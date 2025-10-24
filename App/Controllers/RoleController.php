<?php

namespace App\Controllers;

use App\Models\Roles;

class RolesController
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