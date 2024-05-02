<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    public function getById($id)
    {
        return $this->roleRepository->getById($id);
    }

    public function create($data)
    {
        return $this->roleRepository->create($data);    
    }

    public function update($id,$data)
    {
        return $this->roleRepository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->roleRepository->delete($id);    
    }

    public function paginate($row)
    {
        return $this->roleRepository->paginate($row);    
    }
    
}

?>