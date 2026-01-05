<?php

namespace App\Services;

use App\BusinessObject\UserBO;
use Illuminate\Support\Facades\Cache;

class UserService
{
    private const TAG = 'users';
    private const TTL = 600;

    public function __construct(private UserBO $userBO) {}

    public function getAll($request)
    {
        // return Cache::tags(self::TAG)->remember('all', self::TTL, function () use ($request) {
        //     return $this->userBO->getAllUsers($request);
        // });

        // Disabled caching for listing users to ensure real-time data with filters/pagination
        return $this->userBO->getAllUsers($request);
    }

    public function create(array $data)
    {
        $user = $this->userBO->createUser($data);

        Cache::tags(self::TAG)->flush();

        return $user;
    }

    public function getById(int $id)
    {
        return Cache::tags(self::TAG)->remember("user_{$id}", self::TTL, function () use ($id) {
            return $this->userBO->getUser($id);
        });
    }

    public function update(int $id, array $data)
    {
        $user = $this->userBO->updateUser($id, $data);

        Cache::tags(self::TAG)->flush();

        return $user;
    }

    public function delete(int $id): bool
    {
        $deleted = $this->userBO->deleteUser($id);

        Cache::tags(self::TAG)->flush();

        return $deleted;
    }
}
