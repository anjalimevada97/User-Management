<?php

namespace App\DataAccessObject;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserDAO
{
    public function all($request)
    {
        $users = User::applyFilters($request->all())
            ->latest()
            ->paginate(10);

        return UserResource::collection($users);
    }

    public function create(array $data): UserResource
    {
        $user = User::create($data);

        return new UserResource($user);
    }

    public function findById(int $id): ?UserResource
    {
        $user = User::find($id);

        throw_if(! $user, ValidationException::withMessages([
            'user' => 'User not found.'
        ]));

        return new UserResource($user);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function update(int $id, array $data): UserResource
    {
        $user = User::findOrFail($id);
        $user->update($data);

        return new UserResource($user);
    }
}
