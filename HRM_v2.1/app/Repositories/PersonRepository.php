<?php

namespace App\Repositories;

use App\Models\Person;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PersonRepository
{
    public function getAll()
    {
        try {
            return Person::all();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getById($id)
    {
        try {
            return Person::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data)
    {
        try {
            return Person::create($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $person = Person::findOrFail($id);
            return $person->update($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $person = Person::findOrFail($id);
            return $person->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate($row)
    {
        try {
            return Person::paginate($row);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

?>