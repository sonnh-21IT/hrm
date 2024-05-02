<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskRepository
{
    public function getAll()
    {
        try {
            return Task::all();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getById($id)
    {
        try {
            return Task::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data)
    {
        try {
            return Task::create($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $task = Task::findOrFail($id);
            return $task->update($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $task = Task::findOrFail($id);
            return $task->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate($row)
    {
        try {
            return Task::paginate($row);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function filter($companyId, $projectId, $personId, $status, $priority, $row){
        $query = Task::query();

        if ($companyId) {
            $query->whereHas('project.company', function ($query) use ($companyId) {
                $query->where('id', $companyId);
            });
        }

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        if ($personId) {
            $query->where('person_id', $personId);
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($priority) {
            $query->where('priority', $priority);
        }

        return $query->paginate($row);
    }

    public function searchByName($name,$row){
        return Task::where('name', 'like', '%'.$name.'%')->paginate($row);
    }
}

?>