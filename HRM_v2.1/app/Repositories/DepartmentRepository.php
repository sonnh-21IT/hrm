<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DepartmentRepository
{
    public function getAll()
    {
        try {
            return Department::all();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getById($id)
    {
        try {
            return Department::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data)
    {
        try {
            return Department::create($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $department = Department::findOrFail($id);
            return $department->update($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $department = Department::findOrFail($id);
            return $department->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate($row)
    {
        try {
            return Department::paginate($row);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

?>