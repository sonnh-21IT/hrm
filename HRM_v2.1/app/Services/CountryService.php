<?php

namespace App\Services;

use App\Repositories\CountryRepository;

class CountryService
{
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function getAll()
    {
        return $this->countryRepository->getAll();
    }

    public function getById($id)
    {
        return $this->countryRepository->getById($id);
    }

    public function create($data)
    {
        return $this->countryRepository->create($data);    
    }

    public function update($id,$data)
    {
        return $this->countryRepository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->countryRepository->delete($id);    
    }

    public function paginate($row)
    {
        return $this->countryRepository->paginate($row);    
    }
    
}

?>