<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function getAll()
    {
        return $this->projectRepository->getAll();
    }

    public function getById($id)
    {
        return $this->projectRepository->getById($id);
    }

    public function create($data)
    {
        return $this->projectRepository->create($data);    
    }

    public function update($id,$data)
    {
        return $this->projectRepository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->projectRepository->delete($id);    
    }

    public function paginate($row)
    {
        return $this->projectRepository->paginate($row);    
    }
    
}

?>