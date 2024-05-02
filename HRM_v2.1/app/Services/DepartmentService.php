<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService
{
    protected $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getAll()
    {
        return $this->departmentRepository->getAll();
    }

    public function getById($id)
    {
        return $this->departmentRepository->getById($id);
    }

    public function create($data)
    {
        return $this->departmentRepository->create($data);    
    }

    public function update($id,$data)
    {
        return $this->departmentRepository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->departmentRepository->delete($id);    
    }

    public function paginate($row)
    {
        return $this->departmentRepository->paginate($row);    
    }
    
}

?>