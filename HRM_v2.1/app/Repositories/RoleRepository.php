<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleRepository
{
    public function getAll()
    {
        try {
            return Role::all();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getById($id)
    {
        try {
            return Role::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data)
    {
        try {
            return Role::create($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $role = Role::findOrFail($id);
            return $role->update($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $role = Role::findOrFail($id);
            return $role->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate($row)
    {
        try {
            return Role::paginate($row);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

?>