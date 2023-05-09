<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\CreateUserDto;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public UserService $userService;
    
    public function __construct(UserService $userService) 
    {
        $this->userService = $userService;
    }

    public function store(CreateUserRequest $request): UserResource
    {
        $user = $this->userService->create(
            new CreateUserDto(
                email: $request->input('email'),
                name: $request->input('name'),
                password: $request->input('password')
            )
        );

        return UserResource::make($user);
    }
}


// use App\Models\User;
// use Illuminate\Http\JsonResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rules\Password;


// class UserController extends Controller
// {
//     public function store(Request $request): JsonResponse
//     {
//         $validated = $request->validate([
//             'name' => 'required|max:255',
//             'email' => 'required|unique:users|email:rfc,dns',
//             'password' => [
//                 'required',
//                 Password::min(8)
//                     ->letters()
//                     ->mixedCase()
//                     ->numbers()
//                     ->symbols()
//                     ->uncompromised(),
//             ],
//         ]);

//         $user = User::query()->create([
//             'name' => $validated['name'],
//             'email' => $validated['email'],
//             'password' => Hash::make($validated['password']),
//         ]);

//         return response()->json(['data' => $user]);
//     }
// }