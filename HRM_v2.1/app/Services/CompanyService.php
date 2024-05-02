<?php

namespace App\Services;

use App\Repositories\CompanyRepository;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getAll()
    {
        return $this->companyRepository->getAll();
    }

    public function getById($id)
    {
        return $this->companyRepository->getById($id);
    }

    public function create($data)
    {
        return $this->companyRepository->create($data);    
    }

    public function update($id,$data)
    {
        return $this->companyRepository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->companyRepository->delete($id);    
    }

    public function paginate($row)
    {
        return $this->companyRepository->paginate($row);    
    }
    
}

?>