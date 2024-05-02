<?php

namespace App\Repositories;

use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryRepository
{
    public function getAll()
    {
        try {
            return Country::all();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getById($id)
    {
        try {
            return Country::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data)
    {
        try {
            return Country::create($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $country = Country::findOrFail($id);
            return $country->update($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $country = Country::findOrFail($id);
            return $country->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate($row)
    {
        try {
            return Country::paginate($row);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

?>