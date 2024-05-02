<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectRepository
{
    public function getAll()
    {
        try {
            return Project::all();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getById($id)
    {
        try {
            return Project::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data)
    {
        try {
            return Project::create($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $project = $this->getById($id);
            $result = $project->update($data);
            if($result){
                return $this->getById($id);
            }
            return null;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $project = Project::findOrFail($id);
            return $project->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate($row)
    {
        try {
            return Project::paginate($row);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

?>