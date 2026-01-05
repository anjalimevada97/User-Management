<?php

namespace App\BusinessObject;

use App\DataAccessObject\UserDAO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserBO
{
    public function __construct(private UserDAO $userDAO) {}

    public function getAllUsers()
    {
        return $this->userDAO->all();
    }

    public function createUser(array $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']); // encryption
        }

        return $this->userDAO->create($data);
    }

    public function getUser(int $id)
    {
        return $this->userDAO->findById($id);
    }

    public function updateUser(int $id, array $data)
    {
        return $this->userDAO->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return User::where('id', $id)->delete();
    }
}
