<?php

namespace App\Services;

use App\Repositories\CustomUserRepository;

class CustomUserService
{
    protected $customUserRepository;

    public function __construct(CustomUserRepository $customUserRepository)
    {
        $this->customUserRepository = $customUserRepository;
    }

    public function getAll()
    {
        return $this->customUserRepository->getAll();
    }

    public function getById($id)
    {
        return $this->customUserRepository->getById($id);
    }

    public function create($data)
    {
        return $this->customUserRepository->create($data);    
    }

    public function update($id,$data)
    {
        return $this->customUserRepository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->customUserRepository->delete($id);    
    }

    public function paginate($row)
    {
        return $this->customUserRepository->paginate($row);    
    }
    
}

?>