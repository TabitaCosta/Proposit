<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository
{
    public function getAll()
    {
        return Role::with('users')->get();
    }

    public function getById(int $id)
    {
        return Role::with('users')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Role::create($data);
    }

    public function update(Role $role, array $data)
    {
        $role->update($data);
        return $role->fresh('users');
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }
}
