<?php

namespace App\Repositories;

use App\Models\Company;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompanyRepository
{
    public function getAll()
    {
        try {
            return Company::all();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getById($id)
    {
        try {
            return Company::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data)
    {
        try {
            return Company::create($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $company = Company::findOrFail($id);
            return $company->update($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $company = Company::findOrFail($id);
            return $company->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate($row)
    {
        try {
            return Company::paginate($row);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

?>