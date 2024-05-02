<?php

namespace App\Services;

use App\Repositories\PersonRepository;

class PersonService
{
    protected $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function getAll()
    {
        return $this->personRepository->getAll();
    }

    public function getById($id)
    {
        return $this->personRepository->getById($id);
    }

    public function create($data)
    {
        return $this->personRepository->create($data);    
    }

    public function update($id,$data)
    {
        return $this->personRepository->update($id,$data);
    }

    public function delete($id)
    {
        return $this->personRepository->delete($id);    
    }

    public function paginate($row)
    {
        return $this->personRepository->paginate($row);    
    }
    
}

?>