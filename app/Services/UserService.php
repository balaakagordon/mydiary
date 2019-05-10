<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Repositories\UserInterface;

class UserService implements UserInterface
{
    public function validateCredentials($request)
    {
        return Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'confirmedPassword' => 'required|same:password',
        ]);
    }

    public function createUser($credentials)
    {
        $credentials['password'] = bcrypt($credentials['password']);
        return User::create($credentials);
    }

    public function getToken($user)
    {
        $success['token'] = $user->createToken('MyDiary')->accessToken;
        $success['firstName'] = $user->firstName;
        $success['lastName'] = $user->lastName;
        return $success;
    }

    public function successResponse($success)
    {
        return response()->json(['success' => $success], 200);
    }

    public function unauthorizedResponse($error = 'Unauthorized')
    {
        return response()->json(['error' => $error], 401);
    }
}