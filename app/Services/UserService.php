<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\CreateUserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(CreateUserDto $dto): User
    {
        return User::query()->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);
    }
}