<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAll()
    {
        return $this->taskRepository->getAll();
    }

    public function getById($id)
    {
        return $this->taskRepository->getById($id);
    }

    public function create($data)
    {
        return $this->taskRepository->create($data);    
    }

    public function update($id,$data)
    {
        return $this->taskRepository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->taskRepository->delete($id);    
    }

    public function paginate($row)
    {
        return $this->taskRepository->paginate($row);    
    }
    
    public function filter($companyId, $projectId, $personId, $status, $priority, $row){
        return $this->taskRepository->filter($companyId, $projectId, $personId, $status, $priority, $row);
    }

    public function searchByName($name,$row) {
        return $this->taskRepository->searchByName($name,$row);
    }
}

?>