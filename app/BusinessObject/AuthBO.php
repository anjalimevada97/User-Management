<?php

namespace App\BusinessObject;

use App\DataAccessObject\UserDAO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthBO
{
    public function __construct(private UserDAO $userDAO) {}

    /**
     * Register new user
     */
    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userDAO->create($data);
    }

    /**
     * Login user
     */
    public function login(string $email, string $password)
    {
        $user = $this->userDAO->findByEmail($email);

        throw_unless($user && Hash::check($password, $user->password),
            ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ])
        );

        throw_if($user->status === User::STATUS_DISABLED,
            ValidationException::withMessages([
                'error' => 'User is not active.',
            ])
        );

        return $user->createToken('default')->accessToken;
    }
}
