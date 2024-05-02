<?php

namespace App\Repositories;

use App\Models\CustomUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomUserRepository
{
    public function getAll()
    {
        try {
            return CustomUser::all();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function getById($id)
    {
        try {
            return CustomUser::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function create($data)
    {
        try {
            return CustomUser::create($data);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function update($id, $data)
    {
        try {
            $customUser = CustomUser::findOrFail($id);
            $result = $customUser->update($data);
            if($result){
                return CustomUser::findOrFail($id);
            }
            return null;
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $customUser = CustomUser::findOrFail($id);
            return $customUser->delete();
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

    public function paginate($row)
    {
        try {
            return CustomUser::paginate($row);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}

?>